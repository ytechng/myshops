<td></td>
<td>{{ $category->name }}</td>
<td>{{ $category->parent_id }}</td>
<td>{{ $category->description }}</td>
<td>{{ $category->url }}</td>
<td>{{ $category->status === 1 ? 'Enabled' : 'Disabled'  }}</td>
<td>
    <a href="#categoryModal{{ $category->id }}" class="btn btn-success btn-sm" data-toggle="modal"><i class="fa fa-eye" data-toggle="tooltip" title="View {{ $category->name }}"></i></a> |

    <a href="{{ url('/admin/categories/edit/' . base64_encode($category->id)) }}" class="btn btn-info btn-sm"><i class="fa fa-edit" data-toggle="tooltip" title="Edit {{ $category->name }}"></i></a> |

    <a class="btn btn-danger btn-sm deleteRecord" rel="{{ $category->id }}" rel1="{{ $category->name }}" rel2="{{ $category->status }}" href="javascripts:"><i class="fa fa-eye-slash" data-toggle="tooltip" title="Enable or Disable {{ $category->name }}"></i></a>
</td>