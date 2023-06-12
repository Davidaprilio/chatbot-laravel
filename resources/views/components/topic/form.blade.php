<form class="row g-3" action="{{ route('topic.save', ['topic' => $topic->id ?? null]) }}" method="POST" {{ $attributes }}>
    @csrf
    <div class="col-12 mb-3">
        <div class="d-flex justify-content-between">
            <label class="form-label" for="judul_topic">Title</label>
            <div>
                <small>Pin</small>
                <label class="checkbox checkbox--circle" title="pin to top">
                    <input type="checkbox" name="pinned">
                    <span class="checkbox__marker">
                        <span class="checkbox__marker-icon"></span>
                    </span>
                </label>
            </div>
        </div>
        <input type="text" id="judul_topic" name="title" class="form-control input"
            placeholder="Enter title topic" value="{{ $topic->name ?? '' }}" />
    </div>
    <div class="col-12 mb-3">
        <label class="form-label">Description</label>
        <div class="input-editor">
            {{-- <div class="js-description-editor" style="min-height: 200px"></div> --}}
            <textarea name="desc" id="desc" cols="30" rows="10" class="form-control">{{ $topic->description ?? '' }}</textarea>
        </div>
    </div>
    <div class="col-12 text-center">
        <button type="submit" id="submit-btn" class="btn btn-primary me-sm-3 me-1">Save</button>
    </div>
</form>
