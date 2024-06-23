<div class="content">
  <div class="container">
    <div class="page-title">
      <h3>Subscriptions</h3>
    </div>
    <div class="card">
      <div class="card-body">
        <table class="table table-hover table-bordered" id="dataTables" width="100%">
          <thead>
            <tr>
              <th>Created</th>
              <th>Customer</th>
              <th>Plan</th>
              <th>Next Billing</th>
              <th>Total Cost</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="tableBody"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@push('other-scripts')
<script>
  function formatDate(newDate) {
    const date = new Date(newDate);
    let text = date.toUTCString();
    let parts = text.split(' ');
    let formattedDate = `${parts[1]} ${parts[2]} ${parts[3]}`;
    return formattedDate;
  }


  allSubscriptions();

  async function allSubscriptions() {
    await axios.get('/all-subscriptions').then(function(response) {
      let mainTable = $('#dataTables');
      let tableBody = $('#tableBody');
      let btnClass = ''

      mainTable.DataTable().clear().destroy();

      response.data.forEach(function(item, index) {
        let newRow = `<tr>
          <td>${formatDate(response.data[index].start_date)}</td>
          <td>${response.data[index].customer.fullname}</td>
          <td>${(response.data[index].plan.name).split(' ')[0]}</td>
          <td>${formatDate(response.data[index].next_billing_date)}</td>
          <td>${parseInt(response.data[index].total_cost)}</td>
          <td>
              <select class="statusBtn">
                <option value="active" selected>Active</option>
                <option value="inactive">In-Active</option>
                <option value="restricted">Restricted</option>
              </select>
          </td>
          </tr>`;
        tableBody.append(newRow);
        let status = response.data[index].status;
        let statusBtn = tableBody.find('tr:last-child .statusBtn');
        statusBtn.val(status);
        if (status == 'active') {
          statusBtn.addClass('btn btn-sm btn-success fw-bold');
        } else if (status == 'inactive') {
          statusBtn.addClass('btn btn-sm btn-danger fw-bold');
        } else {
          statusBtn.addClass('btn btn-sm btn-warning fw-bold');
        }
      });

      mainTable.DataTable();
    })
  }

  $('table tbody').on('click', '.deleteBtn', function() {
    let id = $(this).data('id');
    $('#deleteModal').modal('show');
    $('#deleteID').val(id);
  })

  $('table tbody').on('click', '.updateBtn', function() {
    let id = $(this).data('id');
    $('#updateModal').modal('show');
    $('#updateID').val(id);
    getPlanInfo();
  })

  $('select .statusBtn').on('change', function() {
    console.log(this.value);
  });
</script>
@endpush