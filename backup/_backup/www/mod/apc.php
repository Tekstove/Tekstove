<?php $stats = apc_cache_info(); ?>
<style type="text/css">
    
    .apc_table{
        
    }
    
    .apc_table td{
        text-align: center;
    }
    
</style>

<table class="apc_table">
    <tr>

        <th>num_hits</th>
        <th>filename_short</th>
        <th>type</th>
        <th>filename</th>
        <th>mem_size</th>

        <th>access_time</th>
        <th>creation_time</th>
        <th>del. time</th>
        <th>mtime</th>
        <th>ref_count</th>
        <th>ref_count</th>
        <th>inode</th>

    </tr>
    <?php
    foreach ($stats['cache_list'] as $v):

        $v['filename_short'] = preg_replace('/.*\/(.*\.php)$/i', '<b>$1</b>', htmlspecialcharsX($v['filename']));
        ?><tr>

            <td><?php echo htmlspecialcharsX($v['num_hits']); ?>&nbsp;&nbsp;</td>
            <td><?php echo ($v['filename_short']); ?></td>
            <td><?php echo htmlspecialcharsX($v['type']); ?> </td>
            <td><?php echo htmlspecialcharsX($v['filename']); ?></td>
            <td><?php echo htmlspecialcharsX($v['mem_size']); ?></td>

            <td><?php echo htmlspecialcharsX($v['access_time']); ?></td>
            <td><?php echo htmlspecialcharsX($v['creation_time']); ?></td>
            <td><?php echo htmlspecialcharsX($v['deletion_time']); ?></td>
            <td><?php echo htmlspecialcharsX($v['mtime']); ?></td>
            <td><?php echo htmlspecialcharsX($v['ref_count']); ?></td>
            <td><?php echo htmlspecialcharsX($v['ref_count']); ?></td>
            <td><?php echo htmlspecialcharsX($v['inode']); ?></td>

        </tr>
        <?php
    endforeach;
    unset($stats['cache_list']);
    ?></table><?php
    echo '<pre>';
    echo htmlspecialcharsX(print_r($stats, 1));
    echo '</pre>';