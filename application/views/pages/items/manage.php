<ul class="breadcrumb">
    <li><a href="<?php echo base_url("/"); ?>">Home</a> <span class="divider">/</span></li>
    <li class="active">Items</li>
</ul>
<div class="page-header">
    <h1>Items</h1>
</div>
<div class="row">
    <div class="span6">
        <div class="pagination scp-pagination">
            <!--        <ul>
                      <li><a href="#">Prev</a></li>
                      <li><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">4</a></li>
                      <li><a href="#">Next</a></li>
                    </ul>-->
        </div>
    </div>
    <div class="span3">
        <div class="btn-group pull-right"> <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"> Category Filter <span class="caret"></span> </a>
            <ul class="dropdown-menu">
                <?php foreach ($categories as $category): ?>
                    <li><a href="?c=<?= $category['require_plugin'] ?>"><?= $category['display_name'] ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="span3">
        <form class="form-search pull-right" action ="<?php echo base_url("index.php/items") ?>" method="get">
            <div class="input-append">
                <input type="text" class="span2 search-query" name="s" value="<?= $search ?>">
                <button type="submit" class="btn">Search</button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() 
    { 
        $("#manageItems").tablesorter(); 
    } 
); 
</script>
<table id="manageItems" class="tablesorter table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Item Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Times Bought</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><a href="<?php echo base_url('index.php/items/edit') . '/' . $item['id']; ?>"><?= $item['id'] ?></a></td>
                <td><a href="<?php echo base_url('index.php/items/edit') . '/' . $item['id']; ?>"><?= $item['display_name'] ?></a></td>
                <td><?= $item['type'] ?></td>
                <td><?= $item['price'] ?></td>
                <td><a href="<?php echo base_url('index.php/items/bought_by') . '/' . $item['id']; ?>"><?= $item['amount'] ?></td>
                <td>
                    <form class="float-left removeform" action="<?php echo base_url('index.php/items/process') ?>" method="post">
                        <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                        <button class="btn btn-small btn-danger" name="action" value="remove" type="submit"><i class="icon-remove icon-white"></i> Remove</button>
                        <button class="btn btn-small btn-danger" name="action" value="remove_refund" type="submit"><i class="icon-remove icon-white"></i> Remove + Refund</button>
                        
                    </form> 
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="pagination">
    <!--    <ul>
          <li><a href="#">Prev</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">Next</a></li>
        </ul>-->
</div>
