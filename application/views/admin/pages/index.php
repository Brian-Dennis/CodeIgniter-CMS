<h2 class="page-header">Pages</h2>
<!-- Success Message Output -->
<?php if($this->session->flashdata('success')) : ?>
    <?php echo '<div class="alert alert-success">'.$this->session->flashdata('success').'</div>'; ?>
<?php endif; ?>
<!-- Error Message Output -->
<?php if($this->session->flashdata('error')) : ?>
    <?php echo '<div class="alert alert-danger">'.$this->session->flashdata('error').'</div>'; ?>
<?php endif; ?>

<?php if($pages) : ?>
    <table class="table table-striped">
        <thead>
            <th>ID</th>
            <th>Published</th>
            <th>Title</th>
            <th>Author</th>
            <th>Date Created</th>
            <th></th>
        </thead>
        <?php foreach($pages as $page) : ?>
        <!-- Check for published then set glyphicon to display rather than 1 for yes or 0 for no. -->
        <?php if($page->is_published) : ?>
            <?php $publish_icon = 'glyphicon glyphicon-ok'; ?>
        <?php else : ?>
            <?php $publish_icon = 'glyphicon glyphicon-remove'; ?>
        <?php endif; ?>
        <?php $date = strtotime($page->create_date); ?>
        <?php $formatted_date = date('F j, Y, g:i a', $date); ?>
            <tbody>
                <td><?php echo $page->id; ?></td>
                <td><span class="<?php echo $publish_icon; ?>"></span></td>
                <td><?php echo $page->title; ?></td>
                <td><?php echo 'SOME USER'; ?></td>
                <td><?php echo $formatted_date; ?></td>
                <td>
                    <?php echo anchor('admin/pages/edit/'.$page->id.'', 'Edit', 'class="btn btn-warning"'); ?>
                    <?php echo anchor('admin/pages/delete/'.$page->id.'', 'Delete', 'class="btn btn-danger"'); ?>
                </td>
            </tbody>
        <?php endforeach; ?>
    </table>
<?php else : ?>
    <p>No Pages</p>
<?php endif; ?>
