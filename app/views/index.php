<div class="row">
    <h1 class="display-4">Add new job</h1>
</div>
<div class="row mt-2">
    <form class="col-md-12" action="/job/create" method="post">
        <div class="form-group">
            <input class="form-control <?=(isset($data['form']['errors']['name']))?'is-invalid':'';?>" type="text" name="name" placeholder="Name" value="<?=$data['form']['name']??'';?>">
            <?if(isset($data['form']['errors']['name'])){?>
                <div class="invalid-feedback"><?=$data['form']['errors']['name']?></div>
            <?}?>
        </div>
        <div class="form-group">
            <input class="form-control <?=(isset($data['form']['errors']['email']))?'is-invalid':'';?>" type="text" name="email" placeholder="E-mail" value="<?=$data['form']['email']??'';?>">
            <?if(isset($data['form']['errors']['email'])){?>
                <div class="invalid-feedback"><?=$data['form']['errors']['email']?></div>
            <?}?>
        </div>
        <div class="form-group">
            <textarea class="form-control <?=(isset($data['form']['errors']['text']))?'is-invalid':'';?>" name="text" placeholder="Text"><?=$data['form']['text']??'';?></textarea>
            <?if(isset($data['form']['errors']['text'])){?>
                <div class="invalid-feedback"><?=$data['form']['errors']['text']?></div>
            <?}?>
        </div>
        <div class="form-group">
            <input class="form-control" type="submit" value="Submit">
        </div>
    </form>
</div>

<div class="row">
    <h1 class="display-4">Job list</h1>
</div>

<div class="row">
    <div class="sort col-md-12 mb-2">
        <strong>Sort by</strong>
        <div class="row">
            <div class="div col-md-6">
                <select name="sort" class="form-control">
                    <option <?=(Helper::getString('sort')=='id')?'selected':''?> value="id">Default</option>
                    <option <?=(Helper::getString('sort')=='name')?'selected':''?> value="name">Name</option>
                    <option <?=(Helper::getString('sort')=='email')?'selected':''?> value="email">Email</option>
                    <option <?=(Helper::getString('sort')=='status')?'selected':''?> value="status">Status</option>
                </select>
            </div>
            <div class="div col-md-6">
                <select name="order" class="form-control">
                    <option <?=(Helper::getString('order')=='asc')?'selected':''?> value="asc">Ascending</option>
                    <option <?=(Helper::getString('order')=='desc')?'selected':''?> value="desc">Descending</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <?foreach ($data['jobs'] as $job){?>
        <div class="card col-md-12 p-0 mb-2 <?=($job['status']=='1')?'text-white bg-success':''?>">
            <div class="card-header">
                <?=$job['name'];?> <kbd><?=$job['email'];?></kbd>
                <?if(Helper::isAdmin()){?><a class="btn btn-sm float-right" href="/job/<?=$job['id'];?>/edit">Edit</a><?}?>
            </div>
            <div class="card-body">
                <p class="card-text"><?=$job['text'];?></p>
            </div>
        </div>
    <?}?>
</div>

<div class="navigation col-md-12">
    <ul class="pagination">
        <?for ($i = 1; $i <= $data['pagenator']['count']; $i++){?>
            <li class="page-item <?=($data['pagenator']['current']==$i)?'active':'';?>"><a href="/?page=<?=$i?>" class="page-link"><?=$i?></a></li>
        <?}?>
    </ul>
</div>