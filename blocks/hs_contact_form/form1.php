<?php defined('C5_EXECUTE') or die(_("Access Denied."));?>

<p>
<?php print Loader::helper('concrete/ui')->tabs(array(
	array('form-emails', t('Email Addresses'), true), // true partially 'activates' this tab so that content is displayed. does not give it focus though :-(
));?>
</p>

<script type="text/javascript">
	//Todo:  move to auto.js
	var itemsAdded = 0;
	var categoryEmail = {
	focusElement: null,
    addChildToMe: function (el) {
    	if (el)
    	{
    		var clickParent = $(el).closest('a');
    		var childCount = clickParent.attr('data-children');
    		var isFirstTopic = childCount == 0;
    		var newElement = null;
    		var key = null;
    		var targetKey = null;
    		if (!isFirstTopic)
    		{
			    itemsAdded++;
			    $(clickParent.attr('href') + '-hidden').hide(600);
    			key = clickParent.attr('href').substr(1);  //eg: 'item-10' from '#item-10'
	    		targetKey = $('#' + key);   		
    			key += '-' + itemsAdded;
			    newElement = $('#new-topic-template').clone(); // new jquery DOM element
			    $('span', newElement).eq(0).html('New Topic');
			    newElement.find('a').eq(0).attr('href', '#' + key);
			    newElement.find('div.list-group')
			    	.attr('id', key).find('.list-group-item')
			    	.attr('id', key + '-hidden');
			    newElement.find('input').each(function(){
			    	var fieldName = $(this).attr('name');
			    	if (fieldName == 'parentSeID')
			    	{
			    		var parentId = clickParent.attr('data-id');
			    		if (parentId == '0')
			    		{
							parentId = clickParent.attr('href').substr(1);
			    		}
						$(this).attr('value', parentId);
			    	}
					$(this).attr('id', 'cat_' + key + '_' + fieldName);
					$(this).attr('name', 'cat[' + key + '][' + fieldName + ']');
					var label = $(this).siblings('label').eq(0);
					if (label)
					{
						label.attr('for', $(this).attr('id'));
						label.html($(this).attr('title'));
					}
				});
	    		if (clickParent.attr('aria-expanded') != 'true')
	    		{
	    			clickParent.click();	
				}
				$('.glyphicon-none', clickParent).removeClass('glyphicon-none');
	    		$(newElement.html()).prependTo($(targetKey)).click(); 
			}
			else
			{
			    itemsAdded++;
			    $(clickParent.attr('href') + '-hidden').hide(600);
    			key = clickParent.attr('href').substr(1);  //eg: 'item-10' from '#item-10'
	    		targetKey = $('#' + key);   		
    			key += '-' + itemsAdded;
			    newElement = $('#new-topic-template').clone(); // new jquery DOM element
			    $('span', newElement).eq(0).html('New Topic');
			    newElement.find('a').eq(0).attr('href',  '#' + key);
			    newElement.find('div.list-group')
			    	.attr('id', key).find('.list-group-item')
			    	.attr('id', key + '-hidden');
			    newElement.find('input').each(function(){
			    	var fieldName = $(this).attr('name');
			    	if (fieldName == 'parentSeID')
			    	{
			    		var parentId = clickParent.attr('data-id');
			    		if (parentId == '0')
			    		{
							parentId = clickParent.attr('href').substr(1);
			    		}
						$(this).attr('value', parentId);
			    	}
					$(this).attr('id', 'cat_' + key + '_' + fieldName);
					$(this).attr('name', 'cat[' + key + '][' + fieldName + ']');
					var label = $(this).siblings('label').eq(0);
					if (label)
					{
						label.attr('for', $(this).attr('id'));
						label.html($(this).attr('title'));
					}
				});
	    		if (clickParent.attr('aria-expanded') != 'true')
	    		{
	    			clickParent.click();	
				}
				$('.glyphicon-none', clickParent).removeClass('glyphicon-none');
	    		$(newElement.html()).appendTo($(targetKey).first()).click(); 
			}
			childCount++;
			clickParent.attr('data-children', childCount);
		}
    	else
    		alert('epic fail');
	},
    editMe: function (el) {
    	var clickParent = $(el).closest('a');
    	var key = clickParent.attr('href') + '-hidden';
    	//
    	//  If the container is currently collapsed, show the container first 
    	//  and then show the key element. Otherwise, toggle key element visibility.
    	//
	    if (clickParent.attr('aria-expanded') != 'true')
	    {
	    	var displayMode = '' + $(key).css('display');
	    	clickParent.click();
    		if(displayMode == 'none' || displayMode == 'undefined')
    		{
    			$(key).show(600);	
    		}
		}
    	else
    	{
    		$(key).toggle(600);
		}
	},
	deleteMe: function (el, seID, parentSeID) {
    	if (el)
    	{
    		var clickParent = $(el).closest('a');
    		if (confirm('Are you sure you want to delete ' + $('.category-title', clickParent).html() + '?'))
    		{
				$('#deleted-items').val($('#deleted-items').val() + clickParent.attr('data-id') + ',');
    			var key = clickParent.attr('href').substr(1);  //eg: 'item-10' from '#item-10'
	    		var targetKey = $('#' + key);   		
				clickParent.remove();
				$(targetKey).remove();
			}
		}
	},
    moveUp: function (el, seID, parentSeID) {
    	alert('up');
        this.saveOrder();
    },
    moveDown: function (el, seID, parentSeID) {
    	alert('down');
        this.saveOrder();
    },
    saveOrder: function () {
    }
			
	};

	$(function() {
		
		//
		//  The following allows me to capture the "Cancel" button of the C5 Edit dialog.
		//
    	var oldOnClick = $('.btn-hover-danger').attr('onclick');
    	$('.btn-hover-danger').attr('onclick', '');
        $('.btn-hover-danger').on('click', function(){
        	//
        	//  Now we can check if any data has changed, warn the user
        	//  and allow or disallow the cancel action based on their response.
        	//
			if(confirm('Are you sure that you want to cancel?'))
			{
				eval(oldOnClick);  //jQuery.fn.dialog.closeTop();
			}
        });

		$('.list-group-root').on('click', '.list-group-item',  function() {
			$('.glyphicon', this)
				.toggleClass('glyphicon-chevron-right')
				.toggleClass('glyphicon-chevron-down');
		});

		//
		//  This (somehow) pre-empts the click handler above and, by returning false,
		//  allows the onclick defined on the toolbar icon to work.
		//
		$('.list-group-root').on('click', '.ccm-icon-wrapper',  function() {
			return false;
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
			newElement.find('div.list-group')
			    .attr('id', key).find('.list-group-item')
			    .attr('id', key + '-hidden');
			newElement.find('input').each(function() {
			    	var fieldName = $(this).attr('name');
					$(this).attr('id', 'cat_' + key + '_' + fieldName);
					$(this).attr('name', 'cat[' + key + '][' + fieldName + ']');
			var label = $(this).siblings('label').eq(0);
			if (label)
			{
				label.attr('for', $(this).attr('id'));
				label.html($(this).attr('title'));
			}
			});
			$(newElement.html()).prependTo($('.list-group-root')).click();
		});

	});

</script>
<style type="text/css">
	.custom-toolbar
	{
		border: 0px solid red;
	}
	.custom-toolbar .ccm-icon-wrapper
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

.glyphicon-none
{
	color: transparent !important;
}	
	
</style>
<div class="ccm-tab-content" id="ccm-tab-content-form-emails">
	<fieldset id="emails">
		<legend style="padding-top: 5px; margin-bottom: 5px;" id="emails">
			<?php echo t('Enquiry Category')?>
			<button id="add-category" class="btn btn-primary btn-xs pull-right">Add Category</button>
		</legend>
        <input id="deleted-items" name="deleted-items" type="hidden" value="" />
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
	<a href="#<?php echo $itemID?>" class="list-group-item" data-toggle="collapse" data-children="<?php echo $childCount; ?>" data-id="<?php echo $parent['seID'];?>">
		<i class="glyphicon glyphicon-chevron-right <?php echo $hasChildren ? '' : 'glyphicon-none'; ?>"></i>
		<span class="category-title"><?php echo $parent['description']?></span>
		<div class="custom-toolbar pull-right">
			<div class="ccm-icon-wrapper pull-right" onclick="categoryEmail.deleteMe(this);return false;"><i class="fa fa-trash"></i></div>
			<div class="ccm-icon-wrapper pull-right" onclick="categoryEmail.editMe(this);return false;"><i class="fa fa-pencil"></i></div>
			<div class="ccm-icon-wrapper pull-right" onclick="categoryEmail.addChildToMe(this);return false;"><i class="fa fa-plus-circle"></i></div>
			<div class="ccm-icon-wrapper pull-right" onclick="categoryEmail.moveDown(this);return false;"><i class="fa fa-chevron-down hidden"></i></div>
			<div class="ccm-icon-wrapper pull-right" onclick="categoryEmail.moveUp(this);return false;"><i class="fa fa-chevron-up hidden"></i></div>
		</div>	
	</a>	
	<div class="list-group collapse" id="<?php echo $itemID?>" >
		<div class="list-group-item" id="<?php echo $itemID?>-hidden">
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
			<input type="hidden" value="<?php echo $inputValue;?>" name="<?php echo $inputName;?>" id="<?php echo $inputId?>"/>
<?php
	$fieldName  = 'parentSeID';
	$inputName  = sprintf('cat[%s][%s]', $parent['seID'], $fieldName);
	$inputId    = sprintf('cat_%s_%s', $parent['seID'], $fieldName);
	$inputValue = $parent["$fieldName"];
?>
			<input type="hidden" value="<?php echo $inputValue;?>" name="<?php echo $inputName;?>" id="<?php echo $inputId?>"/>
<?php
	$fieldName  = 'sortOrder';
	$inputName  = sprintf('cat[%s][%s]', $parent['seID'], $fieldName);
	$inputId    = sprintf('cat_%s_%s', $parent['seID'], $fieldName);
	$inputValue = $parent["$fieldName"];
?>
			<input type="hidden" value="<?php echo $inputValue;?>" name="<?php echo $inputName;?>" id="<?php echo $inputId?>"/>
		</div>
<?php			
		foreach ($children as $child)
		{
			if ($child['parentSeID'] == $parent['seID'])
			{
				$itemID = 'item-' . $parent['seID'] . '-' . $child['seID'] ;
?>
		<a href="#<?php echo $itemID?>" class="list-group-item" data-toggle="collapse" data-id="<?php echo $child['seID'];?>">
			<i class="glyphicon glyphicon-chevron-right glyphicon-none"></i><!--Todo: remove this when edit is working-->
			<span class="category-title"><?php echo $child['description']?></span>
			<div class="custom-toolbar pull-right">
				<div class="ccm-icon-wrapper pull-right" onclick="categoryEmail.deleteMe(this);return false;"><i class="fa fa-trash"></i></div>
				<div class="ccm-icon-wrapper pull-right" onclick="categoryEmail.editMe(this);return false;"><i class="fa fa-pencil"></i></div>
				<div class="ccm-icon-wrapper pull-right" onclick="categoryEmail.addChildToMe(this);return false;"><i class="fa fa-plus-circle hidden"></i></div>
				<div class="ccm-icon-wrapper pull-right" onclick="categoryEmail.moveDown(this);return false;"><i class="fa fa-chevron-down hidden"></i></div>
				<div class="ccm-icon-wrapper pull-right" onclick="categoryEmail.moveUp(this);return false;"><i class="fa fa-chevron-up hidden"></i></div>
			</div>	
		</a>
		<div class="list-group collapse" id="<?php echo $itemID?>" >         
			<div class="list-group-item" id="<?php echo $itemID?>-hidden" >
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
				<input type="hidden" value="<?php echo $inputValue;?>" name="<?php echo $inputName;?>" id="<?php echo $inputId?>"/>
<?php
	$fieldName  = 'seID';
	$inputName  = sprintf('cat[%s][%s]', $child['seID'], $fieldName);
	$inputId    = sprintf('cat_%s_%s', $child['seID'], $fieldName);
	$inputValue = $child["$fieldName"];
?>
				<input type="hidden" value="<?php echo $inputValue;?>" name="<?php echo $inputName;?>" id="<?php echo $inputId?>"/>
<?php
	$fieldName  = 'sortOrder';
	$inputName  = sprintf('cat[%s][%s]', $child['seID'], $fieldName);
	$inputId    = sprintf('cat_%s_%s', $child['seID'], $fieldName);
	$inputValue = $child["$fieldName"];
?>
				<input type="hidden" value="<?php echo $inputValue;?>" name="<?php echo $inputName;?>" id="<?php echo $inputId?>"/>
			</div>
		</div>		
<?php
			}
		}
?>	
	</div>
<?php	
	}
?>
</div>
</fieldset>
</div>
<?php	
	//  Note that the following hidden <div> is a template for creating new categories using jQuery.
	//  It is the easiest way to generate complex html elements.
	//  However, Concrete5 wraps all of the html in this file in a form and even though the <div> is
	//  not displayed, it still ends up in the submitted data.
	//  Hence, we will ignore submitted data from this section when saving data.
	//
	//  Note also that the jQuery code adds the href and id 'hook' and turns the name into the appropriately named array element 
?>
<div id="new-category-template" style="display: none;">
	<a href="#" class="list-group-item" data-toggle="collapse" data-children="0"  data-id="0">
		<i class="glyphicon glyphicon-chevron-right glyphicon-none"></i>
		<span class="category-title">New Category</span>
		<div class="custom-toolbar pull-right">
			<div class="ccm-icon-wrapper pull-right" onclick="categoryEmail.deleteMe(this);return false;"><i class="fa fa-trash"></i></div>
			<div class="ccm-icon-wrapper pull-right" onclick="categoryEmail.editMe(this);return false;"><i class="fa fa-pencil"></i></div>
			<div class="ccm-icon-wrapper pull-right" onclick="categoryEmail.addChildToMe(this);return false;"><i class="fa fa-plus-circle"></i></div>
			<div class="ccm-icon-wrapper pull-right" onclick="categoryEmail.moveDown(this);return false;"><i class="fa fa-chevron-down hidden"></i></div>
			<div class="ccm-icon-wrapper pull-right" onclick="categoryEmail.moveUp(this);return false;"><i class="fa fa-chevron-up hidden"></i></div>
		</div>	
	</a>
	<div class="list-group collapse">
		<div class="list-group-item">
        	<div class="form-group">
        		<label class="control-label" ></label>
				<input class="form-control ccm-input-text" type="text" value="New Category" name="description" title="<?php echo t('Description'); ?>"/>
            </div>
        	<div class="form-group">
        		<label class="control-label" ></label>
				<input class="form-control ccm-input-text" type="text" value="" name="recipientEmail" title="<?php echo t('Recipient Email'); ?>"/>
            </div>
			<input type="hidden" value="0" name="seID" title="<?php echo t('seID'); ?>"/>
			<input type="hidden" value="0" name="parentSeID" title="<?php echo t('parentSeID'); ?>"/>
			<input type="hidden" value="0" name="sortOrder" title="<?php echo t('sortOrder'); ?>"/>
		</div>	
	</div>
</div> 	
<div id="new-topic-template" style="display: none;">
	<a href="#" class="list-group-item" data-toggle="collapse" data-children="0"  data-id="0">
		<i class="glyphicon glyphicon-chevron-right glyphicon-none"></i><!--Todo: remove this when edit is working-->
		<span class="category-title">new category</span>
		<div class="custom-toolbar pull-right">
			<div class="ccm-icon-wrapper pull-right" onclick="categoryEmail.deleteMe(this);return false;"><i class="fa fa-trash"></i></div>
			<div class="ccm-icon-wrapper pull-right" onclick="categoryEmail.editMe(this);return false;"><i class="fa fa-pencil"></i></div>
			<div class="ccm-icon-wrapper pull-right" onclick="categoryEmail.addChildToMe(this);return false;"><i class="fa fa-plus-circle hidden"></i></div>
			<div class="ccm-icon-wrapper pull-right" onclick="categoryEmail.moveDown(this);return false;"><i class="fa fa-chevron-down hidden"></i></div>
			<div class="ccm-icon-wrapper pull-right" onclick="categoryEmail.moveUp(this);return false;"><i class="fa fa-chevron-up hidden"></i></div>
		</div>	
	</a>
	<div class="list-group collapses">
		<div class="list-group-item">
        	<div class="form-group">
        		<label class="control-label" ></label>
				<input class="form-control ccm-input-text" type="text" value="New Topic" name="description" title="<?php echo t('Description'); ?>"/>
            </div>
        	<div class="form-group">
        		<label class="control-label" ></label>
				<input class="form-control ccm-input-text" type="text" value="" name="recipientEmail" title="<?php echo t('Recipient Email'); ?>"/>
            </div>
			<input type="hidden" value="0" name="seID" title="<?php echo t('seID'); ?>"/>
			<input type="hidden" value="0" name="parentSeID" title="<?php echo t('parentSeID'); ?>"/>
			<input type="hidden" value="0" name="sortOrder" title="<?php echo t('sortOrder'); ?>"/>
		</div>	
	</div>
</div> 	