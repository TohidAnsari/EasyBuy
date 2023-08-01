<div class="col-lg-4 col-6 text-left">
    <form action="{{route('product-search')}}">
        <div class="input-group">
            @csrf
            <input type="hidden" class="form-control" name="productCategory_id" value="{{ $productCategory_id }}">
            <!-- <input type="hidden" class="form-control" name="productCategory" value="{{ $productCategory }}"> -->
            <input type="text" class="form-control typeahead" placeholder="Search for products" name="search">
            <div class="input-group-append">
                <span class="input-group-text bg-transparent text-primary">
                    <i class="fa fa-search"></i>
                </span>
            </div>
        </div>
    </form>
    <script>
        var path = "HeaderSearchComponent@autocomplete";
        $('input.typeahead').typeahead({
            source: function(terms, proccess){
                return $.get(path, {terms:terms}, function(data){
                    return proccess(data);
                });
            }
        });
    </script>
</div>
