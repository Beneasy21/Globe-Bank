<?php
    require_once('../../../private/initialize.php');
        

    
    if(is_post_request()){
      $page = []; 
      $page['subject_id'] = $_POST['subject_id'] ?? '';
      $page['menu_name'] = $_POST['menu_name'] ?? '';
      $page['position'] = $_POST['position'] ?? '';
      $page['visible'] = $_POST['visible'] ?? '';
      $page['content'] = $_POST['content'] ?? '';

      $result = insert_page($page);
      $new_id =mysqli_insert_id($db);
      redirect_to(url_for('/staff/pages/show.php?id='.$new_id));
      
    } else {
      $page =[];
      $page['subject_Id'] ='';
      $page['menu_name'] ='';
      $page['position'] = '';
      $page['visible'] = '';
      $page['content'] = '';

      $page_count = count_all_pages()+1;
    }

    $page_title = 'Create Page';
    include(SHARED_PATH. '/staff_header.php')
    

?>    
    
<div class="content">
    <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>
    <div class="page new">
        <h1> Create Page </h1>
        <form action="<?php echo url_for('/staff/pages/new.php'); ?>" method='post'>
         <dl>
            <dt>Subject</dt>
            <dd>
              <select name="subject_id">
                <?php 
                  $result = find_all_subjects();
                  while ($subject = mysqli_fetch_assoc($result) ){
                    echo "<option value=\"".h($subject['id'])."\"";
                    if($page["subject_Id"] == $subject['id']){
                      echo " selected";
                    }
                    echo ">".h($subject['menu_name'])."</option>";
                  }
                  mysqli_free_result();
                ?>  
              </select>
            </dd>
          </dl>
         <dl>
            <dt>Menu Name</dt>
            <dd><input type="text" name="menu_name" value="<?php echo h($page['menu_name']) ?>" /></dd>
          </dl>
          
          <dl>
            <dt>Position</dt>
            <dd>
              <select name="position">
                <?php 
                  for ($a='1'; $a<=$page_count ; $a++ ){
                    echo "<option value=\"{$a}\"";
                    if($page['position'] == $a){
                      echo " selected";
                    }
                    echo ">{$a}</option>";
                  }
                ?>
              </select>
            </dd>
          </dl>
          <dl>
            <dt>Visible</dt>
            <dd>
              <input type="hidden" name="visible" value="0" />
              <input type="checkbox" name="visible" value="1"<?php if($page['visible'] =='1'){echo "checked";} ?> />
            </dd>
          </dl>
          <div id="operations">
            <input type="submit" name="submit" value="Create Page" />
          </div>
        </form>
    
    </div>
   
</div>