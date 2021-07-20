<div class="row justify-content-center">
    <div class="col-md-12">
        <din class="card">
            <div class="card body">
                <div class="card-title"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a href="#maindata" class="nav-link active" data-toggle="tab" role="tab">Main data</a>
                    </li>
                </ul>
                <br>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input name="title"
                                   value="{{ old('title',$item->title) }}"
                                   id="title"
                                   type="text"
                                   class="form-control"
                                   minlength="3"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input name="slug" value="{{old('slug',$item->slug)}}"
                                   id="slug"
                                   type="text"
                                   class="form-control"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="parent_id">Parent</label>
                            <select name="parent_id"
                                    id="parent_id"
                                    class="form-control"
                                    placeholder="Select Category"
                                    required>
                                @foreach($categoryList as $categoryOption)
                                    <option value="{{$categoryOption->id}}"
                                            @if($categoryOption->id == $item->parent_id)  selected @endif>
                                        {{$categoryOption->id}}.{{$categoryOption->title}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description"
                                      id="description"
                                      class="form-control"
                                      rows="3"
                                      required> {{old('description',$item->descriprion)}}{{$item->descriprion}}
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </din>
    </div>
</div>
