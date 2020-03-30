<?php require_once('../../../private/initialize.php');

$id = $_GET['id'] ?? '1';


$subject = find_subject_by_id($id);



$page_title = 'Show Subject';

include (SHARED_PATH . '/staff_header.php');
?>
<div class="content">
<a class="back-link" href="<?php echo url_for('staff/subjects/index.php');?>">&laquo;Back to list</a>
    <div class="subject show">
    <h1>Subject: <?php echo h($subject['menu_name']); ?></h1>
        <div class="attributes">
            <dl>
                <dt>Menu Name</dt>
                <dd><?php echo h($subject['menu_name']); ?></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd><?php echo h($subject['position']); ?></dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd><?php echo $subject['visible'] == '1' ? 'true' : 'false'; ?></dd>
            </dl>
        </div>
    </div>
</div>
<?php  include (SHARED_PATH . '/staff_footer.php'); ?>