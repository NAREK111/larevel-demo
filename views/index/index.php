<div class="row">
    <div class="col-md-offset-1 ">
        <form action="/index/index" method="post">
            <div class="form-group" style="width: 100px">
                <label for="sel1">Database:</label>
                <select class="form-control" id="sel1" name="database">
                    <option value="<? echo MYSQL ?>">Mysql</option>
                    <option value="<? echo MY_JSON ?>"> Json</option>
                  <!--  <option value="<?/* echo MY_XML */?>">Xml</option>-->
                </select>
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
</div>
