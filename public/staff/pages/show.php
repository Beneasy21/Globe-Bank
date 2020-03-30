<?php require_once('../../../private/initialize.php');

$id = $_GET['id'] ?? '1';

$pages = find_pages_by_id($id);

$page_title = 'Show Page';

include (SHARED_PATH . '/staff_header.php');
?>
<div class="content">
<a class="back-link" href="<?php echo url_for('staff/pages/index.php');?>">&laquo;Back to list</a>
    <div class="page show">
        <dl>
            <dt>Subject</dt>
            <dd><?php echo h($pages['sub_name']) ;?></dd>
        </dl>
        <dl>
            <dt>Menu Name:</dt>
            <dd><?php echo h($pages['menu_name']) ;?></dd>
        </dl>
        <dl>
            <dt>Position</dt>
            <dd><?php echo h($pages['position']) ;?></dd>
        </dl>
        <dl>
            <dt>Visible</dt>
            <dd><?php echo $pages['visible']==1 ? 'true' : 'false' ;?></dd>
        </dl>
        <dl>
            <dt>Content</dt>
            <dd><?php echo h($pages['content']) ;?></dd>
        </dl>
    </div>
    
</div>
<?php  include (SHARED_PATH . '/staff_footer.php'); ?>