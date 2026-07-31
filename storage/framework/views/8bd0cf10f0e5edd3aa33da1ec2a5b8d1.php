<?php $__env->startSection('content'); ?>
    <div class="container">

        <h2>Categories</h2>

        <a href="<?php echo e(route('admin.categories.create')); ?>">+ Add</a>

        <?php if(session('success')): ?>
            <p style="color:green"><?php echo e(session('success')); ?></p>
        <?php endif; ?>

        <table border="1" width="100%">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Action</th>
            </tr>

            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($cat->id); ?></td>
                    <td><?php echo e($cat->name); ?></td>
                    <td>
                        <?php if($cat->image): ?>
                            <img src="<?php echo e(asset('storage/' . $cat->image)); ?>" width="50">
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('admin.categories.edit', $cat->id)); ?>">Edit</a>

                        <form action="<?php echo e(route('admin.categories.destroy', $cat->id)); ?>" method="POST"
                            style="display:inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button onclick="return confirm('Delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>

        <?php echo e($categories->links()); ?>


    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\migrate\crude\resources\views/categories/index.blade.php ENDPATH**/ ?>