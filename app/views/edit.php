<div class="row">
    <form class="col-md-12" action="/job/<?=$data['id']?>/edit" method="post">
        <div class="form-group">
            <input class="form-control" type="text" name="name" placeholder="Name" value="<?=$data['name']??'';?>" readonly>
        </div>
        <div class="form-group">
            <input class="form-control" type="text" name="email" placeholder="E-mail" value="<?=$data['email']??'';?>" readonly>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="text" placeholder="Text"><?=$data['text']??'';?></textarea>
        </div>
        <div class="form-group">
            <select class="form-control" name="status">
                <option value="0" <?=($data['status']==0)?'selected':'';?>>New</option>
                <option value="1" <?=($data['status']==1)?'selected':'';?>>Completed</option>
            </select>
        </div>
        <div class="form-group">
            <input class="form-control" type="submit" value="Submit">
        </div>
    </form>
</div>