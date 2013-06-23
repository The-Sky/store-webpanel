<ul class="breadcrumb">
    <li><a href="<?php echo base_url("/"); ?>">Home</a> <span class="divider">/</span></li>
    <li><a href="<?php echo site_url("/users"); ?>">Users</a> <span class="divider">/</span></li>
    <li class="active">Edit User</li>
</ul>
<div class="page-header">
    <h1>Edit "<?= $user['name'] ?>"</h1>
</div>
<ul class="nav nav-tabs" id="userTabs">
    <li><a href="#info" data-toggle="tab">Info</a></li>
    <li><a href="#items" data-toggle="tab">Items</a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane" id="info">
        <form class="form-horizontal" action="<?php echo base_url('index.php/users/process'); ?>" method="post">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
            <div class="control-group">
                <label class="control-label" for="userID">ID</label>
                <div class="controls">
                    <input type="text" id="userID" disabled class="input-mini" value="<?= $user['id'] ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="userName">UserName</label>
                <div class="controls">
                    <input type="text" id="userName" name="name" value="<?= $user['name'] ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="userSteamID">Auth</label>
                <div class="controls">
                    <input type="text" id="userSteamID" class="input-medium" name="auth" value="<?= $user['auth'] ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="communityProfileUrl">Community URL</label>
                <div class="controls">
                    <a href="http://steamcommunity.com/profiles/<?= $user['community_url'] ?>" target="_blank">Steam Community Profile</a>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="steamID">SteamID</label>
                <div class="controls">
                    <input type="text" id="steamID" class="input-medium" name="steamID" value="<?= $user['steam_id'] ?>">
                </div>
            </div>
            <div class="control-group">
            </div>
            <div class="control-group">
                <label class="control-label" for="userCredits">Credits</label>
                <div class="controls">
                    <input type="text" id="userCredits" class="input-medium" name="credits" value="<?= $user['credits'] ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="item">Give Item</label>
                <div class="controls">  
                    <input type="text" id="item" class="input-medium" name="item" value="Item #">
                    <button type="submit" style="margin-left: 10px;" name="action" value="add_item" class="btn btn-primary btn-danger"><b>+</b> Add Item</button>
                </div>
                <br>
                <div class="controls"> 
                    <button type="submit" style="margin-left: 10px;" name="specitemadd" value="172" class="btn btn-primary"><b>+</b> VIP</button>
                    <button type="submit" style="margin-left: 10px;" name="specitemadd" value="171" class="btn btn-primary"><b>+</b> Trainee</button>
                    <button type="submit" style="margin-left: 10px;" name="specitemadd" value="170" class="btn btn-primary btn-danger"><b>+</b> Basic Admin</button>
                    <button type="submit" style="margin-left: 10px;" name="specitemadd" value="169" class="btn btn-primary btn-danger"><b>+</b> Advanced Admin</button>
                    <button type="submit" style="margin-left: 10px;" name="specitemadd" value="167" class="btn btn-primary btn-danger"><b>+</b> Super Admin</button>

                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="item">Give Credits</label>
                <div class="controls">  
                    <button type="submit" style="margin-left: 10px;" name="action" value="100" class="btn btn-primary"><b>+</b> 100</button>
                    <button type="submit" style="margin-left: 10px;" name="action" value="250" class="btn btn-primary"><b>+</b> 250</button>
                    <button type="submit" style="margin-left: 10px;" name="action" value="500" class="btn btn-primary"><b>+</b> 500</button>
                    <button type="submit" style="margin-left: 10px;" name="action" value="1000" class="btn btn-primary"><b>+</b> 1,000</button>
                    <button type="submit" style="margin-left: 10px;" name="action" value="2500" class="btn btn-primary"><b>+</b> 2,500</button>
                    <button type="submit" style="margin-left: 10px;" name="action" value="5000" class="btn btn-primary"><b>+</b> 5,000</button>
                    <button type="submit" style="margin-left: 10px;" name="action" value="10000" class="btn btn-primary"><b>+</b> 10,000</button>
                    <button type="submit" style="margin-left: 10px;" name="action" value="15000" class="btn btn-primary"><b>+</b> 15,000</button>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="item">Take Credits</label>
                <div class="controls">  
                    <button type="submit" style="margin-left: 10px;" name="action" value="-100" class="btn btn-primary btn-danger"><b>-</b> 100</button>
                    <button type="submit" style="margin-left: 10px;" name="action" value="-250" class="btn btn-primary btn-danger"><b>-</b> 250</button>
                    <button type="submit" style="margin-left: 10px;" name="action" value="-500" class="btn btn-primary btn-danger"><b>-</b> 500</button>
                    <button type="submit" style="margin-left: 10px;" name="action" value="-1000" class="btn btn-primary btn-danger"><b>-</b> 1,000</button>
                    <button type="submit" style="margin-left: 10px;" name="action" value="-2500" class="btn btn-primary btn-danger"><b>-</b> 2,500</button>
                    <button type="submit" style="margin-left: 10px;" name="action" value="-5000" class="btn btn-primary btn-danger"><b>-</b> 5,000</button>
                    <button type="submit" style="margin-left: 10px;" name="action" value="-10000" class="btn btn-primary btn-danger"><b>-</b> 10,000</button>
                    <button type="submit" style="margin-left: 10px;" name="action" value="-15000" class="btn btn-primary btn-danger"><b>-</b> 15,000</button>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" name="action" value="edit" class="btn btn-primary">Save Changes</button>
                <button type="submit" name="action" value="remove_user" class="btn btn-primary btn-danger"><i class="icon-remove icon-white"></i> Remove</button>
            </div>
        </form>
    </div>
    <div class="tab-pane" id="items">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user_items as $item): ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['display_name'] ?></td>
                        <td><?= $item['category_displayname'] ?></td>
                        <td><form action="<?php echo base_url('index.php/users/process') ?>" method="post">
                                <input type="hidden" name="action" value="remove_item">
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                <input type="hidden" name="user_name" value="<?= $user['name'] ?>">
                                <input type="hidden" name="useritem_id" value="<?= $item['id'] ?>">
                                <input type="hidden" name="item_name" value="<?= $item['display_name'] ?>"><button class="btn btn-mini btn-danger pull-right" type="submit"><i class="icon-remove icon-white"></i> Remove</button></form></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
