<?php

namespace Application\Block\HsContactForm;

use Concrete\Core\Block\BlockController;
use Core;
use Database;
use Loader;
use User;
use Page;
use UserInfo;
use Exception;
use FileImporter;
use FileSet;
use File;
use Config;
use Concrete\Core\File\Version;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends BlockController
{
    protected $btTable = "btHsContactForm";
    protected $btInterfaceWidth = "400";
    protected $btInterfaceHeight = "650";
    protected $btDefaultSet = 'basic';  //  the group in which the block appears in the "add block" menu
    protected $btWrapperClass = 'ccm-ui';

    protected $btEmailsTable = "btHsContactFormSubjectEmail";
    //
    //Todo: this mixes data model concepts in the controller which is not so great.
	protected $recipientEmail = "";
    protected $subjectID = 0;
    protected $topicID = 0;
    protected $success = false;
    protected $thankYouMessage = 'Thank You. Your message has been sent';
 
	public function on_start() 
	{
		//  Get the URL of the current page to use in self redirection.
		$currentPage = Page::getCurrentPage();
		$this->set('currentUrl', $currentPage->getCollectionLink());		
	}   
	
    public function getBlockTypeName()
    {
        return t('Healthscope Contact Us Form');
    }

	/*
	 *  Called before save() but what calls this and how?
    public function validate($data)
    {
        $e = Core::make('error');
        // if (!$data['hospitalName']) {
             $e->add(t('You must enter a Hospital Name.'));
        // }
        return $e;
    }
	 */

    public function getBlockTypeDescription()
    {
        return t('Healthscope Contact Us Form');
    }

    /**
    * Executed when the block is rendered. view.php is subsequently executed.
    * Get your data here and use $this->set(<name>, <value>);
    * 
    */
	public function view() 
	{
//Todo: find the function in form block code
//        if ($this->viewRequiresJqueryUI()) 
//		{
//            $this->requireAsset('css', 'jquery/ui');
//            $this->requireAsset('javascript', 'jquery/ui');
//        }

        $this->requireAsset('css', 'core/frontend/errors');
        if ($this->displayCaptcha) 
		{
            $this->requireAsset('css', 'core/frontend/captcha');
        }

		$db = Database::connection();
		$subjectEmails = array();
		$sql = "select * from `bthscontactformsubjectemail` order by `parentSeID`, `sortOrder`, `description`;";
		
        $subjectEmails = $db->GetAll($sql);    // was query()
		$d = array();      // Converted to json format. We do not want the parent category key in the data.
		$index = array();  // Associative array same as above but includes a key to the parent categories
		                   // so that we can look them up when processing child (topic) records.
		foreach ($subjectEmails as $subjectEmail)
		{
        	// first level is Category and has parentID = 0
			if (intval($subjectEmail["parentSeID"]) == 0)
			{
				$key = intval($subjectEmail['seID']);
				//  create a root node.
				$topics = array();
				if ($subjectEmail['recipientEmail'])
				{
					//  Category has no children so add the root topic structure
					$topics[] = array(
						'description'    => $subjectEmail['description'],
						'recipientEmail' => $subjectEmail['recipientEmail'],
						'sortOrder'      => intval($subjectEmail['sortOrder']),
					);
				}
	            $index[$key] = array(
            		'name' => $subjectEmail['description'],
            		'id' => intval($subjectEmail['seID']),
            		'sortOrder' => intval($subjectEmail['sortOrder']),
            		'topics' => $topics
	            );
	            $d[] = &$index[$key];    // need address of element
			}
			else
			{
				//  create a topic node and add it to the correct root node.
				$key = intval($subjectEmail['parentSeID']);
				$topic = array(
					'id'             => intval($subjectEmail['seID']),
					'description'    => $subjectEmail['description'],
					'recipientEmail' => $subjectEmail['recipientEmail'],
					'sortOrder'      => intval($subjectEmail['sortOrder']) 				
				);
				$a = &$index[$key]['topics'];   // need address of element
				$a[] = $topic;
			}
		}
	        
		$j = json_encode($d);
		$this->set('jsonData', $j);
        $this->set('subjectID', $this->subjectID);
        $this->set('topicID', $this->topicID);
        $this->set('subjectEmails', $subjectEmails);
		$this->set('name', $this->name);
        $this->set('recipientEmail', $this->recipientEmail);
        $this->set('email', $this->email); 
		$this->set('preferredMethod', $this->preferredMethod);
		$this->set('preferredTime', $this->preferredTime);
		$this->set('dayPhone', $this->dayPhone);
		$this->set('eveningPhone', $this->eveningPhone);
		$this->set('message', $this->message);
		$this->set('success', $this->success);
		$this->set('thankYouMessage', $this->thankYouMessage);
	}
	
	/**
	* Executed when the block is added to a page
	* 
	*/
	public function add() {
		// 
	}
	
	/**
	* Executed when a block instance is edited
	* 
	*/
	public function edit() 
	{
		$list = Tools\HealthscopeContactFormSubjectEmail::getList();
		$parentData = array();
		$childData = array();
		foreach ($list as $data)
		{
			if ($data['parentSeID'])
			{
				$childData[] = $data;	
			}
			else
			{
				$parentData[] = $data;
			}	
		}
        $this->set('parentData', $parentData);
        $this->set('childData', $childData);
        
        
        
		$subjectEmails = array();
		$sql = "select * from `bthscontactformsubjectemail` order by `parentSeID`, `sortOrder`, `description`;";
		$db = Database::connection();
		
        $subjectEmails = $db->GetAll($sql);    // was query()
		$d = array();      // Converted to json format. We do not want the parent category key in the data.
		$index = array();  // Associative array same as above but includes a key to the parent categories
		                   // so that we can look them up when processing child (topic) records.
		foreach ($subjectEmails as $subjectEmail)
		{
        	// first level is Category and has parentID = 0
			if (intval($subjectEmail["parentSeID"]) == 0)
			{
				$key = intval($subjectEmail['seID']);
				//  create a root node.
				$topics = array();
				if ($subjectEmail['recipientEmail'])
				{
					//  Category has no children so add the root topic structure
					$topics[] = array(
						'description'    => $subjectEmail['description'],
						'recipientEmail' => $subjectEmail['recipientEmail'],
						'sortOrder'      => intval($subjectEmail['sortOrder']),
						'seID'           => intval($subjectEmail['seID']),
						'parentSeID'     => intval($subjectEmail['parentSeID']),
					);
				}
	            $index[$key] = array(
            		'name' => $subjectEmail['description'],
            		'id' => intval($subjectEmail['seID']),
            		'sortOrder' => intval($subjectEmail['sortOrder']),
					'seID'           => intval($subjectEmail['seID']),
					'parentSeID'     => intval($subjectEmail['parentSeID']),
            		'topics' => $topics
	            );
	            $d[] = &$index[$key];    // need address of element
			}
			else
			{
				//  create a topic node and add it to the correct root node.
				$key = intval($subjectEmail['parentSeID']);
				$topic = array(
					'id'             => intval($subjectEmail['seID']),
					'description'    => $subjectEmail['description'],
					'recipientEmail' => $subjectEmail['recipientEmail'],
					'sortOrder'      => intval($subjectEmail['sortOrder']), 				
					'seID'           => intval($subjectEmail['seID']),
					'parentSeID'     => intval($subjectEmail['parentSeID']),
				);
				$a = &$index[$key]['topics'];   // need address of element
				$a[] = $topic;
			}
		}
        
        $this->set('subjectEmails', $d);
        
        
        
        
        
        
	}
	
	/**
	* Block edit save comes to here.
	* 
	* @param mixed $data contains the POST data
	*/
    public function save($data)
    {
//        parent::save($data);
		$db = Database::connection();	

		//
		//  Handle deletes first.
		//
        $deletedItemIDs = explode(',', $data['deleted-items']);
        foreach($deletedItemIDs as $deletedItemID)
        {
			if($deletedItemID) // ignoring empty from trailing comma and zeros for added items that were also deleted
			{
				//
				//  Delete selected item and any children of that item.
				//
				$sql = "delete from {$this->btEmailsTable} where `seID`=? or `parentSeID`=?";
				$db->query($sql, array($deletedItemID, $deletedItemID)); 
        	}
        }
        //
        //  Now perform any updates of existing data
        //
        $categories = $data['cat'];
        foreach($categories as $key => $category)
        {
			if ($key == $category['seID'])
			{
				$sql = "update {$this->btEmailsTable} set `parentSeID`=?, `description`=?, `recipientEmail`=?, `sortOrder`=? where `seID`=?";
				$db->query($sql, array(
					  $category['parentSeID']
					, $category['description']
					, $category['recipientEmail']
					, $category['sortOrder']
					, $key
				)); 
			}	
        }
        
        //
        //  Now any additions, category first then any topics so we can set parentSeID correctly
        //
        $newCategoryIndex = array();
        foreach($categories as $key => $category)
        {
			if ($key != $category['seID'])
			{
				$level = count(explode('-', $key));
				if ($level == 3) // it is a NEW category
				{
					$sql = "insert into {$this->btEmailsTable} set `parentSeID`=?, `description`=?, `recipientEmail`=?, `sortOrder`=?";
					$db->query($sql, array(
						  $category['parentSeID']
						, $category['description']
						, $category['recipientEmail']
						, $category['sortOrder']
					)); 
					$new_id = $db->Insert_ID();
					$newCategoryIndex[$key] = $new_id;
				}
			}	
        }
        
        foreach($categories as $key => $category)
        {
			if ($key != $category['seID'])
			{
				$level = count(explode('-', $key));
				if ($level == 4) // it is a NEW Topic
				{
					$sql = "insert into {$this->btEmailsTable} set `parentSeID`=?, `description`=?, `recipientEmail`=?, `sortOrder`=?";
					$db->query($sql, array(
						  $newCategoryIndex[$category['parentSeID']]
						, $category['description']
						, $category['recipientEmail']
						, $category['sortOrder']
					)); 
//					$new_id = $db->Insert_ID();
//					$newCategoryIndex[$key] = $new_id;
				}
			}	
        }
        
    }

    public function validate($args) {
        $e = Loader::helper('validation/error');
//        if ($args['fID'] < 1) {
//            $e->add(t('You must select a file.'));
//        }
//        if (trim($args['fileLinkText']) == '') {
//            $e->add(t('You must give your file a link.'));
//        }
		//$e->add(t('This had a problem'));
        return $e;
    }    
    /**
     * User submits the completed survey.
     *
     * @param int $bID
     */
    public function action_submit_form($bID = false)
    {
        if ($this->bID != $bID) {
            return false;
        }

        $ip = Core::make('helper/validation/ip');
        if ($ip->isBanned()) 
        {
            $this->set('invalidIP', $ip->getErrorMessage());
            return;
        }

        $txt = Core::make('helper/text');
        $db = Database::connection();

		$this->recipientEmail = $_POST['recipientEmail'];
        $this->subjectID = intval($_POST['subjectID']);
        $this->name = $_POST['name'];
        $this->email = $_POST['email'];
        $this->preferredMethod = $_POST['preferredMethod'];
        $this->preferredTime = $_POST['preferredTime'];
        $this->dayPhone = $_POST['dayPhone'];
        $this->eveningPhone = $_POST['eveningPhone'];
        $this->message = $_POST['message'];

        $this->subjectText = $_POST['subjectText'];
        $this->topicText = $_POST['topicText'];
        
        //Todo: move validation into separate function?
        $recipientEmailShouldExist = false;
        if ($this->subjectID == 0)
        {
            $errorDetails['subjectID'] = 'Please select a value for Category: ';
            $errors['subjectID'] = $errorDetails['subjectID'];            
        }
        else
        {
            if (array_key_exists('topic', $_POST)) 
            {
                $this->topicID = intval($_POST['topic']);
                if ($this->topicID == 0)
                {
                    $errorDetails['topic'] = "Please select a value for Topic: ";
                    $errors['topic'] = $errorDetails['topic'];            
                }               
                else
                {
                    $recipientEmailShouldExist = true;
                }
            }
            else
            {
                $recipientEmailShouldExist = true;
            }            
        }
        
        if ($recipientEmailShouldExist)
        {
            //  Dropdowns are correctly selected but no value obtained... fall back on ???admin email.
            if (strlen($this->recipientEmail) == 0)
            {
                $errorDetails['recipientEmail'] = t('System Error, no recipient email found: ');
                $errors['recipientEmail'] = $errorDetails['recipientEmail'];
            }            
        }

        if (strlen($this->name) == 0)
        {
            $errorDetails['name'] = t('Please enter a value for Name: ');
            $errors['name'] = $errorDetails['name'];
        }            
        if (strlen($this->email) == 0)
        {
            $errorDetails['email'] = t('Please enter a value for Email: ');
            $errors['email'] = $errorDetails['email'];
        }            
        if (strlen($this->dayPhone) == 0)
        {
            $errorDetails['dayPhone'] = t('Please enter a value for Day Phone: ');
            $errors['dayPhone'] = $errorDetails['dayPhone'];
        }            
        if (strlen($this->message) == 0)
        {
            $errorDetails['message'] = t('Please enter a value for Message: ');
            $errors['message'] = $errorDetails['message'];
        }            
        // check captcha if activated
        //if ($this->displayCaptcha) 
		{
            $captcha = Core::make('helper/validation/captcha');
            if (!$captcha->check()) {
                $errors['captcha'] = t('Incorrect captcha code');
                $_REQUEST['ccmCaptchaCode'] = '';
            }
        }
		
        if (count($errors)) 
		{
            $this->set('formResponse', t('Please correct the following errors:'));
            $this->set('errors', $errors);
            $this->set('errorDetails', $errorDetails);
        }	
		else
		{
			//Todo: investigate anti spam functionality
			$foundSpam = false;
			$this->notifyMeOnSubmission = 1; //Todo: remove this hack and manage this option via block database table
						
			/*
            $antispam = Core::make('helper/validation/antispam');
            if (!$antispam->check($submittedData, 'form_block')) {
                // found to be spam. We remove it
                $foundSpam = true;
                $q = "delete from {$this->btAnswerSetTablename} where asID = ?";
                $v = array($this->lastAnswerSetId);
                $db->Execute($q, $v);
                $db->Execute("delete from {$this->btAnswersTablename} where asID = ?", array($this->lastAnswerSetId));
            }
			*/
            if (intval($this->notifyMeOnSubmission) > 0 && !$foundSpam) 
			{
                if (Config::get('concrete.email.form_block.address') && strstr(Config::get('concrete.email.form_block.address'), '@')) 
				{
                    $formFromEmailAddress = Config::get('concrete.email.form_block.address');
                } 
				else 
				{
                    $adminUserInfo = UserInfo::getByID(USER_SUPER_ID);
                    $formFromEmailAddress = $adminUserInfo->getUserEmail();
                }
                $replyToEmailAddress = $this->email;

                $mh = Core::make('helper/mail');
                $mh->to($this->recipientEmail);
                $mh->from($formFromEmailAddress);
                $mh->replyto($replyToEmailAddress);
                //  addParameter is equivalent to template->set()
                //  and contact_form_submission.php is the template that
                //  sets the global $body for the mail helper (yucky but effective)
                $mh->addParameter('formName', $this->surveyName);
                //Todo: nicer to add a complete data model but...
				$mh->addParameter('name',            h($this->name));
				$mh->addParameter('email',           $this->email);
				$mh->addParameter('preferredMethod', $this->preferredMethod);
				$mh->addParameter('preferredTime',   $this->preferredTime);
				$mh->addParameter('dayPhone',        h($this->dayPhone));
				$mh->addParameter('eveningPhone',    h($this->eveningPhone));
				$mh->addParameter('message',         h($this->message));
				$mh->addParameter('subjectText',     h($this->subjectText));
				$mh->addParameter('topicText',       h($this->topicText));
				
	        	$mh->load('contact_form_submission');
	        	
                $mh->setSubject('Contact Us: Form Submission');
                @$mh->sendMail();
            }
            /*Todo: investigate use of this feature if necessary
            if (!$this->noSubmitFormRedirect) {
                if ($this->redirectCID > 0) {
                    $pg = Page::getByID($this->redirectCID);
                    if (is_object($pg) && $pg->cID) {
                        $this->redirect($pg->getCollectionPath());
                    }
                }
                $c = Page::getCurrentPage();
                header("Location: ".Core::make('helper/navigation')->getLinkToCollection($c, true)."?surveySuccess=1&qsid=".$this->questionSetId."#formblock".$this->bID);
                exit;
            }	
            */	
            
            //  Clear the form data and set success=true	
			$this->recipientEmail = '';
	        $this->subjectID = 0;
	        $this->name = '';
	        $this->email = '';
	        $this->preferredMethod = '';
	        $this->preferredTime = '';
	        $this->dayPhone = '';
	        $this->eveningPhone = '';
	        $this->message = '';
	        
	        $this->success = true;          
		}
        $this->view();
	}
}
