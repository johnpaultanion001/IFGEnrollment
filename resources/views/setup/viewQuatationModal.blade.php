<form method="post" id="formQuatation" class="form-horizontal ">
    @csrf
    <div class="modal" id="modalQuatation" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered ">
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header ">
                    <p class="modal-title  text-uppercase font-weight-bold">Quatation Form</p>
                    <button type="button" class="close " data-dismiss="modal">&times;</button>
                </div>

                    
                <!-- Modal body -->
                <div class="modal-body row">
                            <div class="col-xl-12 mb-4">
                                <div class="card " style="background: #e0e0e0;">
                                    <div class="card-body">
                                        <div class="card border border-primary border-right-0 border-left-0 border-bottom-0 rounded" >
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <p class="fw-bold  text-dark h6">Account Name:</p>
                                                <p  class="fw-bold  text-dark h6 account_name"> </p>
                                            </div>
                                        </div>
                                        <div class="card border border-primary border-right-0 border-left-0 border-bottom-0 rounded" >
                                        <p class="fw-bold mb-1 text-dark">Sales Order</p>
                                            <div class="form-group" style="height:600px; overflow-y: auto; overflow-x: hidden;">
                                                <div id="principal_charge" class="m-2">
                                                    
                                                </div>
                                                <div id="dependents_charge" class="m-2">
                                                   
                                                </div>
                                               
                                                <div class="parentContainer m-2">
                                                    <hr>
                                                    <div class="row childrenContainer">
                                                        <div class="col-10">
                                                           
                                                            <p class="text-dark h5 ">SUBTOTAL</p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="text-dark h5 subtotal font-weight-bold">0</p>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div id="charge_section">

                                                </div>
                                                <div class="parentContainer m-2">
                                                    <hr>
                                                    <div class="row childrenContainer">
                                                        <div class="col-10">
                                                           
                                                            <p class="text-dark h5">TOTAL</p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="text-dark h5 total font-weight-bold">0</p>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                        </div>
                                        </div>
                                        
                                        <p class="text-danger font-weight-bold">* To remove, Leave the item field blank.</p >
                                        <div class="card-footer border-0 bg-body-tertiary p-2 d-flex justify-content-around">
                                            
                                            <a
                                            class="btn btn-info m-0 add_charge text-white font-weight-bold"
                                            target="_blank"
                                            role="button"
                                            data-ripple-color="primary"
                                            data-mdb-ripple-init
                                            >ADD CHARGE</a>
                                        </div>
                                      

                                        
                                    </div>
                               
                                    </div>
                            </div>
                                                    

                    <input type="hidden" name="action" id="action" value="Add" />
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                    <input type="submit" name="action_button" id="action_button" class="text-uppercase btn btn-primary" value="FOR PAYMENT" />
                </div>
        
            </div>
        </div>
    </div>
</form>


<script>

    var memberID = "";
    function viewQuatation(id){
        memberID = id;
        $.ajax({
            url :"/admin/quatation/" + id,
            dataType:"json",
            beforeSend:function(){
            },
            success:function(data){
                console.log(data.result);
                $.each(data.result, function(key,value){
                    if(key == 'name'){
                        $('.account_name').text(value)
                    }

                    if(key == 'subtotal'){
                        $('.subtotal').text(value);
                    }
                    if(key == 'total'){
                        $('.total').text(value);
                    }


                    if(key == 'principal'){
                        var princ = '';
                        princ +=   `
                            <div class="row childrenContainer">
                                <div class="col-10">
                                    <h6>Item</h6>
                                    <p class="text-dark h5">`+value.item+`</p>
                                    <input type="hidden"  name="qmember[p`+value.id+`][qid]" class="form-control" value="`+value.qid+`" />
                                    <input type="hidden"  name="qmember[p`+value.id+`][id]" class="form-control" value="`+value.id+`" required/>
                                    <input type="hidden"  name="qmember[p`+value.id+`][item]" class="form-control" value="`+value.item+`" required/>
                                    <input type="hidden"  name="qmember[p`+value.id+`][type]" class="form-control" value="`+value.type+`" required/>
                                </div>
                                <div class="col-2">
                                    <h6>Amount</h6>
                                    <input type="text"  name="qmember[p`+value.id+`][amount]" class="form-control" value="`+value.amount+`" required/>
                                </div>
                                
                            </div>
                        `;

                        $('#principal_charge').empty().append(princ);
                    }
                    if(key == 'dependents'){
                        var depend = "";
                        $.each(value, function(key,value){
                            depend += `
                                <div class="row childrenContainer">
                                    <div class="col-10">
                                        <h6>Item</h6>
                                        <p class="text-dark h5">`+value.item+`</p>
                                        <input type="hidden"  name="qmember[d`+key+`][qid]" class="form-control" value="`+value.qid+`" />
                                        <input type="hidden"  name="qmember[d`+key+`][id]" class="form-control" value="`+value.id+`" required/>
                                        <input type="hidden"  name="qmember[d`+key+`][item]" class="form-control" value="`+value.item+`" required/>
                                        <input type="hidden"  name="qmember[d`+key+`][type]" class="form-control" value="`+value.type+`" required/>
                                    </div>
                                    <div class="col-2">
                                        <h6>Amount</h6>
                                        <input type="text"  name="qmember[d`+key+`][amount]" class="form-control" value="`+value.amount+`" required/>
                                    </div>
                                    
                                </div>
                            `;
                        });
                        $('#dependents_charge').empty().append(depend);
                    }
                    if(key == 'charges'){
                        var charge = "";
                        $.each(value, function(key,value){
                            charge += `
                                <div class="parentContainer m-2">
                                    <div class="row childrenContainer">
                                        <div class="col-10">
                                            <h6>Item</h6>
                                            <input type="hidden"  name="qmember[cs`+key+`][qid]" class="form-control" value="`+value.qid+`" />
                                            <input type="hidden"  name="qmember[cs`+key+`][id]" class="form-control" value="`+value.id+`" />
                                            <input type="text"  name="qmember[cs`+key+`][item]" class="form-control"  value="`+value.item+`" />
                                            <input type="hidden"  name="qmember[cs`+key+`][type]" class="form-control" value="`+value.type+`" />
                                            
                                        </div>
                                        <div class="col-2">
                                            <h6>Amount</h6>
                                            <input type="text"  name="qmember[cs`+key+`][amount]" class="form-control"  value="`+value.amount+`" />
                                        </div>
                                        
                                    </div>
                                </div>
                            `;
                        });
                        $('#charge_section').empty().append(charge);
                    }
                })
            }
        })


    }

    var count = 0;
    $(document).on('click', '.add_charge', function () {
        count++;

        var html = '';
        html += `
            <div class="parentContainer m-2">
                <div class="row childrenContainer">
                    <div class="col-10">
                        <h6>Item</h6>
                        <input type="hidden"  name="qmember[c`+count+`][qid]" class="form-control" value="0`+count+`" />
                        <input type="hidden"  name="qmember[c`+count+`][id]" class="form-control" value="`+memberID+`" />
                        <input type="text"  name="qmember[c`+count+`][item]" class="form-control" />
                        <input type="hidden"  name="qmember[c`+count+`][type]" class="form-control" value="addCharge" />
                        
                    </div>
                    <div class="col-2">
                        <h6>Amount</h6>
                         <input type="text"  name="qmember[c`+count+`][amount]" class="form-control"  />
                    </div>
                    
                </div>
            </div>
        `;
        $('#charge_section').append(html);
    });

    $('#formQuatation').on('submit', function(event){
        event.preventDefault();
    
        var action_url = "/admin/quatation/" + memberID;
        var type = "POST";

        $.ajax({
            url: action_url,
            method:type,
            dataType:"json",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function(){
                $("#action_button").attr("disabled", true);
            },
            success:function(data){
                $("#action_button").attr("disabled", false);
                
                if(data.success){
                    console.log(data.success)
                }
            }
        });
        
    });

</script>