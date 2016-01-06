 <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
  <div class="wrapper">
    <div class="find_footer">
      <ul>
        <li class="need_first">Find what you need</li>
        <li><a href="<?php echo WWW_BASE.'courses/index?startdate=DESC';?>" >Browse by course category</a></li>
        <li><a href="<?=WWW_BASE.'trainers/index?Name=ASC'?>">Browse by training provider</a></li>
        <li><a href="<?=WWW_BASE?>locations">Browse by location</a></li>
        <li class="tip"><a href="javascript:void(0)">Useful links</a>
          <div class="tooltip">
		  <? foreach($usefull_links as $link){?>
			<a href="<?=$link['Link']['link']?>" target="_blank"><?=$link['Link']['title']?></a>  
		  <? }?>
		 
        </li>
      </ul>
      <ul>
	  <li class="need_first">upcoming courses</li>
	  <?//pr($footer_courses);die;
	    foreach($footer_courses as $val){
	  ?>        
        <li><a href="<?=WWW_BASE?>courses/view/<?=$val['Course']['slug']?>"><?= $this->Text->truncate($val['Course']['name'],22,array('ellipsis' => '...','exact' => true)); ?></a></li>
		<? }?>        
        <li><a href="<?= WWW_BASE ?>courses/upcoming?start_date=<?= date('Y-m')?>" class="see_b">SEE ALL</a></li>
      </ul>
      <ul>
        <li class="need_first">about us</li>
		<?php $pages = $this->Custom->get_pages();?>
		<?php 
		if(!empty($pages)){
		foreach($pages as $page){?>
		    <?php if($page['Page']['id'] != 14){?>
		    <li><?php echo $this->html->link($page['Page']['page_title'],'/pages/content/'.$page['Page']['page_url'],array('escape'=>false));?></li>
		<?php }}} ?>
        <div class="social_icon">
          <ul>
            <li><?php echo $this->html->link($this->html->image('in.png',array('escape'=>false)),WWW_BASE.'users/contact_us',array('escape'=>false,'target'=>'
			_blank'));?></li>
            <li><?php echo $this->html->link($this->html->image('fb.png',array('escape'=>false)),'https://www.facebook.com/mytrainingmu-1616606751888433/timeline/',array('escape'=>false,'target'=>'_blank'));?></li>
            <li><?php echo $this->html->link($this->html->image('mail.png',array('escape'=>false)),'mailto:k.lim@mytraining.mu',array('escape'=>false,'target'=>'_blank'));?></li> 
          </ul>
        </div>
      </ul>
      <ul>
        <li class="need_first">stay in touch</li>
		<?php
			echo $this->Form->create('User',array('id'=>'NewsLetterForm'));
			echo $this->Form->input('fname',array('type'=>'text','label'=>false,'placeholder'=>'Your First name'));
			echo $this->Form->input('lname',array('type'=>'text','label'=>false,'placeholder'=>'Your Last name'));
			echo $this->Form->input('email',array('type'=>'text','label'=>false,'placeholder'=>'Your email address'));
			echo $this->Form->submit('keep me updated');
			echo $this->Form->end();
		?>
      </ul>
    </div>
  </div>

  <script>
  
  // When the browser is ready...
  $(function() {
  
    // Setup form validation on the #register-form element
    $("#NewsLetterForm").validate({
    
        // Specify the validation rules
        rules: {
            'data[User][fname]': "required",
            'data[User][lname]': "required",
            'data[User][email]': {
                required: true,
                email: true
            }
        },
        
        // Specify the validation error messages
        messages: {
            'data[User][fname]': "Please enter your first name",
            'data[User][lname]': "Please enter your last name",
            'data[User][email]': {
                required: "Please enter your email address",
                email: "Please enter valid email"
            }
        },
        
        submitHandler: function(form) {
			var url = "<?= WWW_BASE;?>users/subscriber";
			$.ajax({
				   type: "POST",
				   url: url,
				   data: $("#NewsLetterForm").serialize(), // serializes the form's elements.
				   success: function(data)
				   {
					   alert(data); // show response from the php script.
				   }
			});
        }
    });
	
	

  });
  




  
  </script>