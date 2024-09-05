<?php defined('C5_EXECUTE') or die(_("Access Denied."));
 
//use Application\Block\HsContactForm\Tools\CHtml;
//$htmlOptions = array(); // key -> value pairs
//$stuff = CHtml::label('some text', 'for ID', $htmlOptions);
?>
<p>
<?php print Loader::helper('concrete/ui')->tabs(array(
	array('form-options', t('Options'), true), // true partially 'activates' this tab so that content is displayed. does not give it focus though :-(
	array('form-emails', t('Email Addresses')),
));?>
</p>
<script type="text/javascript">
	//Todo:  move to auto.js
	var itemsAdded = 0;
	var categoryEmail = {
	focusElement: null,
    addChildToMe: function (el, seID, parentSeID) {
    	// el is meaningless now so we must find the selected element
    	if (this.focusElement)
    	{
    		var clickedElement = this.focusElement;
    		//alert($(this.focusElement).data('children'));
    		var childCount = $(this.focusElement).attr('data-children');
    		//alert('childCount = ' + childCount);
    		var isFirstTopic =  childCount == 0; //Todo: works for true ... need to work this out and react accordingly
    		var newElement = null;
    		var key = null;
    		var targetKey = null;
    		if (!isFirstTopic)
    		{
    			//alert($(this.focusElement).attr('class'));
    			//alert($('span', $(this.focusElement)).eq(0).html());
			    itemsAdded++;
    			key = $(this.focusElement).attr('href').substr(1);  //eg: 'item-10' from '#item-10'
	    		targetKey = $('#' + key);   		
    			key += '-' + itemsAdded;
			    newElement = $('#new-category-template').clone(); // new jquery DOM element
			    $('span', newElement).eq(0).html('New Topic not first');
			    newElement.find('a').eq(0).attr('href', '#' + key);
			    newElement.find('div.list-group').attr('id', key);
			    newElement.find('input').each(function(){
			    	var fieldName = $(this).attr('name');
					$(this).attr('id', 'cat_' + key + '_' + fieldName);
					$(this).attr('name', 'cat[' + key + '][' + fieldName + ']');
					var label = $(this).siblings('label').eq(0);
					//var label = $(this).parent().find('label');
					if (label)
					{
						label.attr('for', $(this).attr('id'));
						label.html($(this).attr('title'));
					}
				});
	    		//$(newElement.html()).insertAfter($(this.focusElement)).click(); 
	    		if ($(clickedElement).attr('aria-expanded') == 'false')
	    			$(clickedElement).click();	
	    		$(newElement.html()).prependTo($(targetKey)).click(); 
			}
			else
			{
			    itemsAdded++;
    			key = $(this.focusElement).attr('href').substr(1);  //eg: 'item-10' from '#item-10'
	    		targetKey = $('#' + key);   		
    			key += '-' + itemsAdded;
			    newElement = $('#new-category-template').clone(); // new jquery DOM element
			    $('span', newElement).eq(0).html('New Topic first');
			    newElement.find('a').eq(0).attr('href',  '#' + key);
			    newElement.find('div.list-group').attr('id', key);
			    newElement.find('input').each(function(){
			    	var fieldName = $(this).attr('name');
					$(this).attr('id', 'cat_' + key + '_' + fieldName);
					$(this).attr('name', 'cat[' + key + '][' + fieldName + ']');
					var label = $(this).siblings('label').eq(0);
					//var label = $(this).parent().find('label');
					if (label)
					{
						label.attr('for', $(this).attr('id'));
						label.html($(this).attr('title'));
					}
				});
				$(targetKey).html('');  // clears the initial form elements etc
	    		$(newElement.html()).prependTo($(targetKey)).click(); 
			}
			childCount++;
	    	if ($(clickedElement).attr('aria-expanded') == 'false')
	    		$(clickedElement).click();	
			$(clickedElement).attr('data-children', childCount);
		}
    	else
    		alert('epic fail');
	},
    editMe: function (el, seID, parentSeID) {
    	alert('edit');
	},
	deleteMe: function (el, seID, parentSeID) {
    	alert('delete');
	},
    moveUp: function (el, seID, parentSeID) {
    	alert('up');
//        var qIDs = this.serialize();
//        var previousQID = 0;
//        for (var i = 0; i < qIDs.length; i++) {
//            if (qIDs[i] == thisQID) {
//                if (previousQID == 0) break;
//                $('#miniSurveyQuestionRow' + thisQID).after($('#miniSurveyQuestionRow' + previousQID));
//                break;
//            }
//            previousQID = qIDs[i];
//        }
        this.saveOrder();
    },
    moveDown: function (el, seID, parentSeID) {
    	alert('down');
//        var qIDs = this.serialize();
//        var thisQIDfound = 0;
//        for (var i = 0; i < qIDs.length; i++) {
//            if (qIDs[i] == thisQID) {
//                thisQIDfound = 1;
//                continue;
//            }
//            if (thisQIDfound) {
//                $('#miniSurveyQuestionRow' + qIDs[i]).after($('#miniSurveyQuestionRow' + thisQID));
//                break;
//            }
//        }
        this.saveOrder();
    },
    saveOrder: function () {
//        var postStr = 'qIDs=' + this.serialize().join(',') + '&qsID=' + parseInt(this.qsID);
//        $.ajax({
//            type: "POST",
//            data: postStr,
//            url: this.serviceURL + "mode=reorderQuestions",
//            success: function (msg) {
//                miniSurvey.refreshSurvey();
//            }
//        });
    }
			
	};

	$(function() {

	  $('.list-group-root').on('click', '.list-group-items',  function() {
	    $('.glyphicon', this)
	      .toggleClass('glyphicon-chevron-right')
	      .toggleClass('glyphicon-chevron-down');
	    categoryEmail.focusElement = this;
	    //alert($(this).parent().attr('class'));
	    //alert($(categoryEmail.focusElement).parent().attr('class'));
	    //alert($(categoryEmail.focusElement).attr('class'));
	  });

		$('#add-category').on('click', function(event) {
			event.preventDefault();
			event.stopImmediatePropagation();
			itemsAdded++;
    		var key = null;
    		var targetKey = null;
    			key = 'new-item';
	    		targetKey = $('#' + key);   		
    			key += '-' + itemsAdded;
			var newElement = $('#new-category-template').clone(); // new jquery DOM element
			$('span', newElement).eq(0).html('New Category');
			newElement.find('a').eq(0).attr('href',  '#' + key);
			newElement.find('div.list-group').attr('id', key);
			newElement.find('input').each(function() {
			    	var fieldName = $(this).attr('name');
					$(this).attr('id', 'cat_' + key + '_' + fieldName);
					$(this).attr('name', 'cat[' + key + '][' + fieldName + ']');
			var label = $(this).siblings('label').eq(0);
			//var label = $(this).parent().find('label');
			if (label)
			{
				label.attr('for', $(this).attr('id'));
				label.html($(this).attr('title'));
			}
			});
			$(newElement.html()).insertBefore($('.list-group-root a:first')).click();
		});

	});

</script>
<style type="text/css">
	.custom-toolbar
	{
		border: 0px solid red;
	}
	.custom-toolbar a
	{
		margin: 0px 2px 0px 2px;
	}
	
	span.category:hover
	{
		background-color: red;		
	}
	
	
.list-group.list-group-root {
    padding: 0;
    overflow: hidden;
}

.list-group.list-group-root .list-group {
    margin-bottom: 0;
}

.list-group.list-group-root .list-group-item {
    border-radius: 0;
    border-width: 1px 0 0 0;
}

.list-group.list-group-root > .list-group-item:first-child {
    border-top-width: 0;
}

.list-group.list-group-root > .list-group > .list-group-item {
    padding-left: 30px;
}

.list-group.list-group-root > .list-group > .list-group > .list-group-item {
    padding-left: 45px;
}

.list-group-item .glyphicon {
    margin-right: 5px;
}	
	
	
</style>
<div class="ccm-tab-content" id="ccm-tab-content-form-emails">
	<fieldset id="emails">
		<legend style="padding-top: 5px; margin-bottom: 5px;" id="emails">
			<?php echo t('Enquiry Category')?>
			<button class="btn btn-default btn-xs pull-right">Add Category</button>
		</legend>
		<div style="margin-bottom: 5px; " class="alert-info well well-sm">
			With selected
			<div class="custom-toolbar pull-right">
				<a href="javascript:void(0)" class="ccm-icon-wrapper pull-right" onclick="categoryEmail.deleteMe(this,10,1);return false"><i class="fa fa-trash"></i></a>
				<a href="javascript:void(0)" class="ccm-icon-wrapper pull-right" onclick="categoryEmail.editMe(this,10,1);return false"><i class="fa fa-pencil"></i></a>
				<a href="javascript:void(0)" class="ccm-icon-wrapper pull-right" onclick="categoryEmail.deleteMe(this,10,1);return false"><i class="fa fa-plus-circle"></i></a>
				<a href="javascript:void(0)" class="ccm-icon-wrapper pull-right" onclick="categoryEmail.moveDown(this,10,1);return false"><i class="fa fa-chevron-down"></i></a>
				<a href="javascript:void(0)" class="ccm-icon-wrapper pull-right" onclick="categoryEmail.moveUp(this,10,1);return false"><i class="fa fa-chevron-up"></i></a>
			</div>	
		</div>
		<ul>
			<li><span class="category">Careers</span>
				<ul>
					<li>General Enquiry
					</li>
					<li>International Nurses
					</li>
					<li>Australian Nurses
					</li>
					<li>Recent Application
					</li>
					<li>Work Experience
					</li>
				</ul>
			</li>
			<li><div class="category" Staff Enquiry</div>
			</li>
			<li><div class="category" Media & Public Relations</div>
			</li>
			<li>National Supply & Procurement
			</li>
			<li>Marketing
			</li>
			<li>Quality & Risk
			</li>
			<li>Investor Information
			</li>
			<li>Feedback
			</li>
			<li>General Enquiry
			</li>
		</ul>
	</fieldset>
</div>
<div class="ccm-tab-content" id="ccm-tab-content-form-options">
	<fieldset id="options">
		<legend style="padding-top: 5px; margin-bottom: 5px;" id="emails">
			<?php echo t('Enquiry Category')?>
			<button id="add-category" class="btn btn-default btn-xs pull-right">Add Category</button>
		</legend>
		<div style="margin-bottom: 5px; " class="alert-info well well-sm">
			With selected
			<div class="custom-toolbar pull-right">
				<a href="javascript:void(0)" class="ccm-icon-wrapper pull-right" onclick="categoryEmail.deleteMe(this,10,1);return false"><i class="fa fa-trash"></i></a>
				<a href="javascript:void(0)" class="ccm-icon-wrapper pull-right" onclick="categoryEmail.editMe(this,10,1);return false"><i class="fa fa-pencil"></i></a>
				<a href="javascript:void(0)" class="ccm-icon-wrapper pull-right" onclick="categoryEmail.addChildToMe(this,10,1);return false"><i class="fa fa-plus-circle"></i></a>
				<a href="javascript:void(0)" class="ccm-icon-wrapper pull-right" onclick="categoryEmail.moveDown(this,10,1);return false"><i class="fa fa-chevron-down"></i></a>
				<a href="javascript:void(0)" class="ccm-icon-wrapper pull-right" onclick="categoryEmail.moveUp(this,10,1);return false"><i class="fa fa-chevron-up"></i></a>
			</div>	
		</div>

<div class="list-group list-group-root well">
<?php
	foreach ($parentData as $parent)
	{
		$children = array();
		//  Find any child data for this parent
		$childCount = 0;
		foreach ($childData as $child)
		{
			if ($child['parentSeID'] == $parent['seID'])
			{
				$childCount++;
				$children[] = $child;
			}
		}
		$hasChildren = $childCount > 0;
		
		$itemID = 'item-' . $parent['seID'];
?>
	<a href="#<?php echo $itemID?>" class="list-group-item" data-toggle="collapse" data-children="<?php echo $childCount; ?>">
		<i class="glyphicon glyphicon-chevron-right"></i>
		<span><?php echo $parent['description']?></span>
		<div class="custom-toolbar pull-right">
			<a href="javascript:void(0)" class="ccm-icon-wrapper pull-right" onclick="categoryEmail.deleteMe(this,10,1);return false"><i class="fa fa-trash"></i></a>
			<a href="javascript:void(0)" class="ccm-icon-wrapper pull-right" onclick="categoryEmail.editMe(this,10,1);return false"><i class="fa fa-pencil"></i></a>
			<a href="javascript:void(0)" class="ccm-icon-wrapper pull-right" onclick="categoryEmail.addChildToMe(this,10,1);return false"><i class="fa fa-plus-circle"></i></a>
			<a href="javascript:void(0)" class="ccm-icon-wrapper pull-right" onclick="categoryEmail.moveDown(this,10,1);return false"><i class="fa fa-chevron-down"></i></a>
			<a href="javascript:void(0)" class="ccm-icon-wrapper pull-right" onclick="categoryEmail.moveUp(this,10,1);return false"><i class="fa fa-chevron-up"></i></a>
		</div>	
	</a>
	<div class="list-group collapse" id="<?php echo $itemID?>">
<?php
		foreach ($children as $child)
		{
			if ($child['parentSeID'] == $parent['seID'])
			{
				$itemID = 'item-' . $parent['seID'] . '-' . $child['seID'] ;
?>
		<a href="#<?php echo $itemID?>" class="list-group-item" data-toggle="collapse">
			<i class="glyphicon glyphicon-chevron-right"></i>
			<span><?php echo $child['description']?></span>
		</a>
		<div class="list-group collapse" id="<?php echo $itemID?>">
			<a href="#" class="list-group-item">
<?php
	$fieldName  = 'description';
	$inputName  = sprintf('cat[%s][%s]', $child['seID'], $fieldName);
	$inputId    = sprintf('cat_%s_%s', $child['seID'], $fieldName);
	$inputValue = $child["$fieldName"];
?>
        		<div class="form-group">
        			<label class="control-label" for="<?php echo $inputId?>"><?php echo t('Description:'); ?></label>
					<input class="form-control ccm-input-text" type="text" value="<?php echo $inputValue;?>" name="<?php echo $inputName;?>" id="<?php echo $inputId?>"/>
				</div>
<?php
	$fieldName  = 'recipientEmail';
	$inputName  = sprintf('cat[%s][%s]', $child['seID'], $fieldName);
	$inputId    = sprintf('cat_%s_%s', $child['seID'], $fieldName);
	$inputValue = $child["$fieldName"];
?>
        		<div class="form-group">
        			<label class="control-label" for="<?php echo $inputId?>"><?php echo t('Recipient Email:'); ?></label>
					<input class="form-control ccm-input-text" type="text" value="<?php echo $inputValue;?>" name="<?php echo $inputName;?>" id="<?php echo $inputId?>"/>
				</div>
<?php
	$fieldName  = 'parentSeID';
	$inputName  = sprintf('cat[%s][%s]', $child['seID'], $fieldName);
	$inputId    = sprintf('cat_%s_%s', $child['seID'], $fieldName);
	$inputValue = $child["$fieldName"];
?>
				<input type="text" value="<?php echo $inputValue;?>" name="<?php echo $inputName;?>" id="<?php echo $inputId?>"/>
<?php
	$fieldName  = 'seID';
	$inputName  = sprintf('cat[%s][%s]', $child['seID'], $fieldName);
	$inputId    = sprintf('cat_%s_%s', $child['seID'], $fieldName);
	$inputValue = $child["$fieldName"];
?>
				<input type="text" value="<?php echo $inputValue;?>" name="<?php echo $inputName;?>" id="<?php echo $inputId?>"/>
<?php
	$fieldName  = 'sortOrder';
	$inputName  = sprintf('cat[%s][%s]', $child['seID'], $fieldName);
	$inputId    = sprintf('cat_%s_%s', $child['seID'], $fieldName);
	$inputValue = $child["$fieldName"];
?>
				<input type="text" value="<?php echo $inputValue;?>" name="<?php echo $inputName;?>" id="<?php echo $inputId?>"/>
			</a>
		</div>		
<?php
			}
		}	
		if (!$hasChildren)
		{
?>
		<a href="#" class="list-group-item">
<?php
	$fieldName  = 'description';
	$inputName  = sprintf('cat[%s][%s]', $parent['seID'], $fieldName);
	$inputId    = sprintf('cat_%s_%s', $parent['seID'], $fieldName);
	$inputValue = $parent["$fieldName"];
?>
        	<div class="form-group">
        		<label class="control-label" for="<?php echo $inputId?>"><?php echo t('Description:'); ?></label>
				<input class="form-control ccm-input-text" type="text" value="<?php echo $inputValue;?>" name="<?php echo $inputName;?>" id="<?php echo $inputId?>"/>
			</div>
<?php
	$fieldName  = 'recipientEmail';
	$inputName  = sprintf('cat[%s][%s]', $parent['seID'], $fieldName);
	$inputId    = sprintf('cat_%s_%s', $parent['seID'], $fieldName);
	$inputValue = $parent["$fieldName"];
?>
        	<div class="form-group">
        		<label class="control-label" for="<?php echo $inputId?>"><?php echo t('Recipient Email:'); ?></label>
				<input class="form-control ccm-input-text" type="text" value="<?php echo $inputValue;?>" name="<?php echo $inputName;?>" id="<?php echo $inputId?>"/>
			</div>
<?php
	$fieldName  = 'seID';
	$inputName  = sprintf('cat[%s][%s]', $parent['seID'], $fieldName);
	$inputId    = sprintf('cat_%s_%s', $parent['seID'], $fieldName);
	$inputValue = $parent["$fieldName"];
?>
			<input type="text" value="<?php echo $inputValue;?>" name="<?php echo $inputName;?>" id="<?php echo $inputId?>"/>
<?php
	$fieldName  = 'parentSeID';
	$inputName  = sprintf('cat[%s][%s]', $parent['seID'], $fieldName);
	$inputId    = sprintf('cat_%s_%s', $parent['seID'], $fieldName);
	$inputValue = $parent["$fieldName"];
?>
			<input type="text" value="<?php echo $inputValue;?>" name="<?php echo $inputName;?>" id="<?php echo $inputId?>"/>
<?php
	$fieldName  = 'sortOrder';
	$inputName  = sprintf('cat[%s][%s]', $parent['seID'], $fieldName);
	$inputId    = sprintf('cat_%s_%s', $parent['seID'], $fieldName);
	$inputValue = $parent["$fieldName"];
?>
			<input type="text" value="<?php echo $inputValue;?>" name="<?php echo $inputName;?>" id="<?php echo $inputId?>"/>
		</a>
<?php			
		}
?>
	</div>
<?php	
	}
?>
</div>
<?php	
	//  Note that the following hidden <div> is a template for creating new categories using jQuery.
	//  It is the easiest way to generate complex html elements.
	//  However, Concrete5 wraps all of the html in this file in a form and even though the <div> is
	//  not displayed, it still ends up in the submitted data.
	//  Hence, we will ignore submitted data with index 'new-item-0' in the controller when saving data.
	//
	//  Note also that the jQuery code adds the href and id 'hook' and turns the name into the appropriately named array element 
?>
<div id="new-category-template" style="display: none;">
	<a href="#" class="list-group-item" data-toggle="collapses" data-children="0">
		<i class="glyphicon glyphicon-chevron-right"></i>
		<span>new category</span>
	</a>
	<div class="list-group collapse">
		<a href="#" class="list-group-item">
        	<div class="form-group">
        		<label class="control-label" ></label>
				<input class="form-control ccm-input-text" type="text" value="" name="description" title="<?php echo t('Description'); ?>"/>
            </div>
        	<div class="form-group">
        		<label class="control-label" ></label>
				<input class="form-control ccm-input-text" type="text" value="" name="recipientEmail" title="<?php echo t('Recipient Email'); ?>"/>
            </div>
			<input type="text" value="" name="seID" title="<?php echo t('seID'); ?>"/>
			<input type="text" value="" name="parentSeID" title="<?php echo t('parentSeID'); ?>"/>
			<input type="text" value="" name="sortOrder" title="<?php echo t('sortOrder'); ?>"/>
		</a>	
	</div>
</div> 	