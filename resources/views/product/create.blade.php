<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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
        <input id="sub" type="text" name="product_name" required>
        @if ($errors->has('name'))
            <small>{{$errors->first('name')}}</small>
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

   
<div id="variants-section">
        <h3>Product Variants</h3>

        <div class="variant" data-index="0">
            <label>Variant Name:</label>
            <input type="text" name="variants[0][variant_name]" required>

            <label>Price:</label>
            <input type="number" name="variants[0][price]" step="0.01" required>

            <label>Quantity:</label>
            <input type="number" name="variants[0][quantity]" required>

            <label>Description:</label>
            <input type="text" name="variants[0][product_details]" required>

            <label>Image:</label>
            <input type="file" name="variants[0][file_path]" required>

            <h4>Attributes</h4>
            @foreach($attributes as $attribute)
                <div>
                    <label>{{ $attribute->name }}</label>
                    <select name="variants[0][attributes][{{ $attribute->id }}]" required>
                        <option value="">Select {{ $attribute->name }}</option>
                        @foreach($attribute->attributeOptions as $option)
                            <option value="{{ $option->id }}">{{ $option->value }}</option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        </div>
    </div>


    <br>
    <button type="button" id="add-variant">Add Another Variant</button>
    
       <button type="submit">Submit</button>
</form>

<script>
    const subCategoryField = document.querySelector('#subcategory');
    const defaultSubCategoryOption = '<option value="">select a subcategory</option>';

    document.querySelector('#category').addEventListener('change', async function () {
        const category = this.value;

        if (category === "") {
            return;
        }

        // Fetch the sub-categories.
        const {data} = await fetchCategories(category);
        const subCategories = data;

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
        for(const subCategory of subCategories) {
            options += `<option value="${subCategory.id}">${subCategory.name}</option>`;
        }

        subCategoryField.innerHTML = options;
        subCategoryField.removeAttribute('disabled');
    }

    /**
     * create product variants
     *
     * 
     */
     //
    //  document.getElementById('add-variant').addEventListener('click', function () {

    // const variantsSection = document.getElementById('variants-section');

    // const variantCount = variantsSection.getElementsByClassName('variant').length;

    // const newVariant = document.createElement('div');
    // newVariant.className = 'variant';

    // newVariant.innerHTML = `
        // <label for="variants[${variantCount}][variant_name]">Variant Name:</label>
        // <input type="text" name="variants[${variantCount}][variant_name]" required>

        // <label for="variants[${variantCount}][price]">Variant Price:</label>
        // <input type="number" name="variants[${variantCount}][price]" step="0.01" required>

        // <label for="variants[${variantCount}][quantity]">QTY:</label>
        // <input type="text" name="variants[${variantCount}][quantity]" required>

        // <label for="variants[${variantCount}][product_details]">Description:</label>
        // <input type="text" name="variants[${variantCount}][product_details]" required>

        // <label for="variants[${variantCount}][file_path]">Image:</label>
        // <input type="file" name="variants[${variantCount}][file_path]" required>
    // `;

    // variantsSection.appendChild(newVariant);
// });


</script>
</body>
</html>

