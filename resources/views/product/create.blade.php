<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="category">Category</label>
        <select id="category" name="category">
            <option value="">select a category</option>

            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="subcategory">Subcategory</label>
        <select id="subcategory" name="subcategory" disabled>
            <option value="">select a subcategory</option>
        </select>
    </div>

    <div>
        <label for="sub">Product-name</label>
        <input id="sub" type="text" name="name" required>
        @if ($errors->has('name'))
            <small>{{$errors->first('name')}}</small>
            @endif
    </div>

    <div class="form-group">
        <label>file-Path</label>
        <input type="file" name="file" required>
        @if ($errors->has('file'))
            <small>{{$errors->first('file')}}</small>
        @endif
    </div>

    <div>
        <label for="brands">brand-name</label>
        <select id="brand" name="brand">
            <option value="">Select a brand</option>

            @foreach($brands as $brand)
                <option value="{{$brand->id}}">{{$brand->name}}</option>
            @endforeach
        </select>

    </div>

    <div>
        <label>Price</label>
        <input type="text" name="price">
        @if ($errors->has('price'))
            <small>{{$errors->first('price')}}</small>
        @endif
    </div>

    <div>
        <label>Description</label>
        <textarea name="description" >

        </textarea>
        @if ($errors->has('description'))
            <small>{{$errors->first('description')}}</small>
        @endif
    </div>
    <button type="submit">Submit</button>
</form>

<script>
    const subCategoryField = document.querySelector('#subcategory');
    const defaultSubCategoryOption = '<option value="">select a subcategory</option>';

    document.querySelector('#category').addEventListener('change', async function() {
       const category = this.value;

       if (category === "") {
           return;
       }

       // Fetch the sub-categories.
        const subCategories = await fetchCategories(category);

       fillSubCategoryField(subCategories);
    });

    /**
     * Fetch sub-categories of a category.
     *
     * @param categoryId
     * @returns {Promise<Response>}
     */
    async function fetchCategories(categoryId) {
        subCategoryField.innerHTML = defaultSubCategoryOption;
        subCategoryField.setAttribute('disabled', 'true');

        const url = `{{ route('api.category.sub-categories', '%*+*%') }}`
            .replace('%*+*%', categoryId);

        const response = await fetch(url);

        return response.json();
    }

    function fillSubCategoryField(subCategories) {
        let options = defaultSubCategoryOption;

        for (const subCategory of subCategories) {
           options += `<option value="${subCategory.id}">${subCategory.name}</option>`;
        }

        subCategoryField.innerHTML = options;
        subCategoryField.removeAttribute('disabled');
    }
</script>
</body>
</html>

