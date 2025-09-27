<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Crud Operation</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    </head>

    <body>
        <div class="bg-dark py-3">
            <h2 class="text-white text-center"> Product</h2>
        </div>
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-md-10 d-flex justify-content-end">
                    <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-10">
                    <div class="card border-0 shadow-lg my-4">
                        <div class="card-header bg-dark">
                            <h3 class="text-white">Create Product</h3>
                        </div>
                        <form enctype="multipart/form-data" action="{{ route('products.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="" class="form-lable h5">Name</label>
                                    <input type="text" value="{{ old('name') }}"
                                        class="@error('name') is-invalid @enderror form-control form-control-lg"
                                        placeholder="Name" name="name">
                                    @error('name')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-lable h5">SKU</label>
                                    <input type="text" value="{{ old('sku') }}"
                                        class="@error('sku') is-invalid @enderror form-control form-control-lg"
                                        placeholder="Sku" name="sku">
                                    @error('sku')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-lable h5">Price</label>
                                    <input type="text" value="{{ old('price') }}"
                                        class="@error('price') is-invalid @enderror form-control form-control-lg"
                                        placeholder="Price" name="price">
                                    @error('price')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-lable h5">Description</label>
                                    <textarea name="description" cols="30" rows="5" class="form-control" placeholder="Description">{{ old('discription') }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-lable h5">Image</label>
                                    <input type="file" class="form-control form-control-lg" placeholder="Img"
                                        name="image">
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-lg btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </body>

</html>
