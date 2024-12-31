@extends('layout')
@section('main')



<div class="container">
    <h2>All Categories</h2>

    <!-- Success Message -->
    @if (Session::has('success'))
        <div class="alert alert-success" style="background:#28272f; color: white;">{{ Session::get('success') }}</div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

    <!-- Add Category Button -->
    <button class="btn btn-primary btn-rounded btn-fw" data-bs-toggle="modal" data-bs-target="#createCategoryModal" style="margin: 10px">
       Create Category
    </button>

    <!-- Category Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>
                        <!-- Category Name with Toggle Arrow -->
                        <span class="d-flex align-items-center">
                            <button class="btn btn-sm btn-link text-decoration-none" onclick="toggleSubcategories({{ $category->id }})">
                                <i class="fas fa-chevron-down" id="toggleIcon{{ $category->id }}"></i>
                            </button>
                            {{ $category->name }}
                        </span>

                      
                    </td>
                    <td>
                        <!--  Action Buttons -->
                        <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-info btn-rounded btn-sm">
                            <i class="fa fa-eye"></i>
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذه الفئة؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-rounded btn-sm" onclick="return confirm('Are You sure?')">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">There are no categories yet</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createCategoryModalLabel">Add new category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Category name</label>
                        <input type="text" name="name" class="form-control" id="categoryName" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Font Awesome for Icons -->

<script>
    function toggleSubcategories(categoryId) {
        const subcategories = document.getElementById(`subcategories${categoryId}`);
        const icon = document.getElementById(`toggleIcon${categoryId}`);
        
        if (subcategories.classList.contains('d-none')) {
            subcategories.classList.remove('d-none');
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        } else {
            subcategories.classList.add('d-none');
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        }
    }
</script>

@endsection
