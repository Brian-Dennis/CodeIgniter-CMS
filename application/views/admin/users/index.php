<div class="row">
    <div class="col-md-12">
        <!-- Success Message Output -->
        <?php if($this->session->flashdata('success')) : ?>
            <?php echo '<div class="alert alert-success">'.$this->session->flashdata('success').'</div>'; ?>
        <?php endif; ?>
        <!-- Error Message Output -->
        <?php if($this->session->flashdata('error')) : ?>
            <?php echo '<div class="alert alert-danger">'.$this->session->flashdata('error').'</div>'; ?>
        <?php endif; ?>
    </div>
</div>

<h2 class="page-header">Users</h2>
<?php if($users) : ?>
<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Username</th>
        <th>Email</th>
        <th>Registered</th>
        <th></th>
    </tr>
    <?php foreach($users as $user) : ?>
        <!-- Format Data -->
        <?php $date = strtotime($user->create_date); ?>
        <?php $formatted_date = date('F j, Y, g:i a', $date); ?>

        <tr>
            <td><?php echo $user->id; ?></td>
            <td><?php echo $user->first_name; ?> <?php echo $user->last_name; ?></td>
            <td><?php echo $user->username; ?></td>
            <td><?php echo $user->email; ?></td>
            <td><?php echo $formatted_date; ?></td>
            <td>
                <?php echo anchor('admin/users/edit/'.$user->id.'', 'Edit', 'class="btn btn-warning"'); ?>
                <?php echo anchor('admin/users/delete/'.$user->id.'', 'Delete', 'class="btn btn-danger"'); ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php else : ?>
    <p>No Users Found</p>
<?php endif; ?>
