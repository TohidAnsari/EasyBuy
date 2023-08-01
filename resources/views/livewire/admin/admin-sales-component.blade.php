<div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-3">
                <div class="card">
                    <div class="card-header">
                        <h3>Update Sale Timer</h3>
                    </div>
                    <div class="card-body">
                        <form action="">
                            <div class="form-group">
                                <label for="dateTime">Sale Timer</label>
                                <input id="dateTime" class="form-control" type="text" name=""
                                    placeholder="YYYY/MM/DD H:M:S">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="" id="status" class="form-control">
                                    <option value="0">inActive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                            <div class="">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function() {
            $("#dateTime").datetimepicker({
                format: 'Y:MM:DD h:m:s',
            }).on('change', function(e) {

            });
        });
    </script>
@endpush
