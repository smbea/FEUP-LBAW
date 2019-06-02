<div class="modal fade" id="createEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form  method="POST" action="{{ url('/createvent') }}">
                {{ csrf_field() }}
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                    <select name="isPrivate" class="custom-select">
                      <option selected>Create public event</option>
                      <option>Create private event</option>
                    </select>
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="eventPhoto justify-content-md-center">
                      <img src="../img/event-placeholder.png">
                      <span class="col-sm-2 col-3 btn btn-secondary btn-file form-control-file"
                        id="exampleFormControlFile1">Upload
                        <input type="file"></span>
                    </div>
                    <div class="p-3">
                      <div id="details" class="mt-5">
                        <span class="uppercase">Details</span>
                        <hr class="mb-3 mt-1">
                        <div id="details-content" class="py-3">
                          <div class="form-row m-0 py-1">
                            <input type="text" id="inputName" class="form-control" name="title" placeholder="Event Title" required
                              autofocus>
                          </div>
      
                          <div class="form-row m-0 py-1">
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="description" placeholder="Description"
                              rows="3"></textarea>
                          </div>
      
                          <div class="form-row m-0 py-1">
                            <input type="text" id="inputName" class="form-control" placeholder="Datepicker" name="date" required
                              autofocus>
                          </div>
      
                          <div class="form-row py-1">
                            <div class="col-md-6 mb-6">
                              <input type="text" class="form-control" id="validationTooltip03" placeholder="Street" name="street" required>
                            </div>
                            <div class="col-md-6 mb-6">
                                <input type="text" class="form-control" id="validationTooltip03" placeholder="City" name="city" required>
                              </div>
                          
                          </div>
                          <div class="form-row py-1">  
                              <div class="col-md-3 mb-3">
                                  <input type="text" class="form-control" id="validationTooltip05" name="zip-code" placeholder="Zip Code"
                                    required>
                                </div>
                                <select name="category" class="ml-auto col-6 custom-select">
                                  @foreach ($categories as $category)
                                    <option>{{$category->name}}</option>
                                  @endforeach
                                  </select>
                          </div>
                    
                        </div>
                      </div>
      
                      <div id="tickets" class="mt-5">
                        <span class="uppercase">Tickets</span>
                        <hr class="mb-3 mt-1">
                        <div id="tickets-content" class="py-3">
                          <ul class="justify-content-center mx-0 row nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="pills-free-tab" data-toggle="pill" href="#pills-free" role="tab"
                                aria-controls="pills-free" aria-selected="false">Free</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="pills-paid-tab" data-toggle="pill" href="#pills-free" role="tab"
                                aria-controls="pills-free" aria-selected="true">Paid</a>
                            </li>
                          </ul>
                          <div class="tab-content" id="pills-tabContent">
                              <div id="capacityDiv" class="form-row m-0 py-1">
                                <div class="col-6 input-group mb-2">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text pl-0"><i class="fas fa-ticket-alt"></i></div>
                                  </div>
                                  <input type="text" class="form-control pl-0" id="inlineFormInputGroup"
                                    placeholder="Capacity"  name="capacity" required>
                                </div>
                                <div id="pricePticket" class="col-6 input-group mb-2" style="display:none">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text pl-0"><i class="fas fa-euro-sign"></i></div>
                                  </div>
                                  <input type="text" class="form-control pl-0" id="inlineFormInputGroup"
                                  name="price" placeholder="Price p/ ticket">
                                </div>
                              </div>
                              <div class="row px-5">
                                <input class="form-check-input" type="checkbox" id="unlimitedTickets"  name="unlimited">
                                <label class="form-check-label" for="unlimitedTickets">Unlimited</label>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div id="invitefriends" class="mt-5">
                        <span class="uppercase">Invite Friends</span>
                        <hr class="mb-3 mt-1">
                        <div id="friends-content" class="py-3">
                          <div class="friendList py-3">
                            <div class="input-group mb-1 row justify-content-center mx-0">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <img src="../img/user.jpg" class="roundRadius">
                                  <span class="ml-2">@username </span>
                                </div>
                              </div>
                              <div class="input-group-append">
                                <div class="input-group-text">
                                  <input type="checkbox" aria-label="Checkbox for following text input">
                                </div>
                              </div>
                            </div>
                            <div class="input-group mb-1 row justify-content-center mx-0">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <img src="../img/user.jpg" class="roundRadius">
                                  <span class="ml-2">@username </span>
                                </div>
                              </div>
                              <div class="input-group-append">
                                <div class="input-group-text">
                                  <input type="checkbox" aria-label="Checkbox for following text input">
                                </div>
                              </div>
                            </div>
                            <div class="input-group mb-1 row justify-content-center mx-0">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <img src="../img/user.jpg" class="roundRadius">
                                  <span class="ml-2">@username </span>
                                </div>
                              </div>
                              <div class="input-group-append">
                                <div class="input-group-text">
                                  <input type="checkbox" aria-label="Checkbox for following text input">
                                </div>
                              </div>
                            </div>
                            <div class="input-group mb-1 row justify-content-center mx-0">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <img src="../img/user.jpg" class="roundRadius">
                                  <span class="ml-2">@username </span>
                                </div>
                              </div>
                              <div class="input-group-append">
                                <div class="input-group-text">
                                  <input type="checkbox" aria-label="Checkbox for following text input">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="createEntBtn">
                        <button type="submit" class="btn btn-secondary">Create</button>
                      </div>  
                </div> 
              </form> 
            </div>
          </div>
        </div>