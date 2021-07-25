<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if($item->is_published)
                    Опубликовано
                @else
                    Черновик
                @endif
            </div>
            <div class="card body">
                <div class="card-title"></div>
                <div class="card-subtitle mb-2 text-muted"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a href="#maindata" class="nav-link active" data-toggle="tab" role="tab">Main data</a>
                    </li>
                    <li class="nav-item">
                        <a href="#add_data" class="nav-link" data-toggle="tab" role="tab">Add data</a>
                    </li>
                </ul>
                <br>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input name="title"
                                   value="{{ old('title',$item->title) }} "
                                   id="title"
                                   type="text"
                                   class="form-control"
                                   minlength="3"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="content_raw">Post</label>
                            <textarea name="content_raw"
                                      id="content_raw"
                                      class="form-control"
                                      rows="20"
                            >{{old('content_raw',$item->content_raw)}}</textarea>

                        </div>
                    </div>

                    <div class="tab-pane" id="add_data" role="tabpanel">
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id"
                                    id="category_id"
                                    class="form-control"
                                    placeholder="Select Category"
                                    required>
                                @foreach($categoryList as $categoryOption)
                                    <option value="{{ $categoryOption->id }}"
                                            @if($categoryOption->id == $item->category_id)  selected @endif>
                                        {{$categoryOption->title}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input name="title"
                                   value="{{ old('slug',$item->slug) }}"
                                   id="slug"
                                   type="text"
                                   class="form-control"
                                   minlength="3"
                                   >
                        </div>
                        <div class="form-group">
                            <label for="excerpt">Выдержка</label>
                            <textarea name="excerpt"
                                      id="excerpt"
                                      class="form-control"
                                      rows="3"> {{old('excerpt',$item->excerpt)}}</textarea>
                        </div>

                        <div class="form-check">
                            <input
                                name="is_published"
                                type="hidden"
                                value="0">

                            <input
                                name="is_published"
                                type="checkbox"
                                class="form-check-input"
                                value="1"
                                @if($item->is_published)
                                checked="checked"
                                @endif>
                            <label for="is_published" class="form-check-label"> Опубликовано</label>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

