<?php
    require_once('../../../private/initialize.php');

    if(!isset($_GET['id'])){
        redirect_to(url_for('/staff/pages/index.php'));
    }

    $id = $_GET['id'];
    
    if(is_post_request()){
    $page = [];
    $page['id'] = $id;
    $page['subject_id'] = $_POST['subject_id'] ?? '';
    $page['menu_name'] = $_POST['menu_name'] ?? '';
    $page['position'] = $_POST['position'] ?? '';
    $page['visible'] = $_POST['visible'] ?? '';
    $page['content'] = $_POST['content'] ?? '';

    $result = update_page($page);
    redirect_to(url_for('/staff/pages/show.php?id='.$id));
    } else {
      
      $page = find_pages_by_id($id);
      $page_count = count_all_pages()+1;
      
    }

    $page_title = 'Create Page';
    include(SHARED_PATH. '/staff_header.php')
    

?>    
    
<div class="content">
    <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>
    <div class="page new">
        <h1> Edit Page </h1>
        <form action="<?php echo url_for('/staff/pages/edit.php?id='.h(u($id))); ?>" method='post'>
        <dl>
            <dt>Subject</dt>
            <dd>
              <select name="subject_id">
                <?php 
                  $result = find_all_subjects();
                  while ($subject = mysqli_fetch_assoc($result) ){
                    echo "<option value=\"".h($subject['id'])."\"";
                    if($page["subject_id"] == $subject['id']){
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
          <dl>
            <dt>Content</dt>
            <dd>
              <textarea name="content" cols="50" rows="5" value="<?php echo h($page['content']); ?>"></textarea>
            </dd>
          </dl>
          <div id="operations">
            <input type="submit" name="submit" value="Edit Page" />
          </div>
        </form>
    
    </div>
   
</div>