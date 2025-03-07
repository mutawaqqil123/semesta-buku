@if ($errors->any())
  <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body tex-center">
          <div class="text-center">
            <lord-icon src="https://cdn.lordicon.com/lltgvngb.json" trigger="loop" delay="1000"
              colors="primary:#000000,secondary:#e8e230" style="width:150px;height:150px">
            </lord-icon>
          </div>
          <ul class="text-center">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        <div class="modal-footer justify-content-center">
          <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


@endif

@session('error')
  <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body tex-center">
          <div class="text-center justify-content-center">
            <lord-icon src="https://cdn.lordicon.com/msyeyaka.json" trigger="loop" delay="1000"
              colors="primary:#000000,secondary:#e83a30" style="width:100px;height:100px">
            </lord-icon>
          </div>
          <p class="text-center">{{ session('error') }}</p>
        </div>
        <div class="modal-footer justify-content-center">
          <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsession

<script>
  $(document).ready(function() {
    $('#errorModal').modal('show');
  });
</script>
