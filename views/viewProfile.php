<!-- create a row to hold the left side card and the main content -->
<div class="row">
  <!-- create the left side card to display the user icon and name -->
  <div class="col-md-4">
    <div class="card mt-5">
      <div class="card-body text-center">
        <!-- use an img element to display the user icon -->
        <img src="https://via.placeholder.com/150" class="rounded-circle mb-4" alt="User Icon" />
        <!-- display the user's name -->
        <h4 class="card-title font-weight-bold mb-0">USERNAME</h4>
      </div>
    </div>
  </div>
  <!-- create the main content section to display the customer information -->
  <div class="col-md-8">
    <div class="card mt-5">
      <div class="card-body">
        <h4 class="card-title text-center font-weight-bold mb-4">Informations</h4>
        <!-- use a form element to display the customer information -->
        <form>
          <!-- input for the customer's name -->
          <div class="form-group">
            <label for="name-input">Name</label>
            <input type="text" class="form-control" id="name-input" value="John Doe" />
          </div>
          <!-- input for the customer's email address -->
          <div class="form-group">
            <label for="email-input">Email</label>
            <input type="email" class="form-control" id="email-input" value="johndoe@example.com" />
          </div>
          <!-- input for the customer's phone number -->
          <div class="form-group">
            <label for="phone-input">Phone</label>
            <input type="tel" class="form-control" id="phone-input" value="555-555-5555" />
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
