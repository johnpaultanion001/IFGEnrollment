@extends('layouts.admin1')
@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header p-2">
            <h4>
                ADMIN SALES
            </h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-items-center table-flush datatable-table display" width="100%">
                    <thead>
                        <tr>
                            <th>

                            </th>
                            <th class="h6">
                                Name
                            </th>
                            <th class="h6">
                                Dependents
                            </th>
                            <th class="h6">
                                MEMBERSHIP TYPE
                            </th>
                            <th class="h6">
                                Endorse To:
                            </th>
                            <th class="h6">
                                Status
                            </th>
                            <th class="h6">
                                Member Status
                            </th>
                            <th class="h6">
                                Last Activity
                            </th>
                            <th class="h6">
                                Created At
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($memberDetails as $data)
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-transparent" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="now-ui-icons ui-1_settings-gear-63"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="btn btn-link m-0 text-reset text-secondary view_quatation" member="{{$data->id ?? ""}}" href="#">View Details</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a class="btn btn-link m-0 text-reset text-dark h6 " href="/admin/membership/principal/{{$data->referral_code ?? ''}}" target="_blank"> {{ $data->last_name ?? '' }}, {{ $data->first_name ?? '' }} ({{ $data->middle_name ?? 'N/A' }}) </a> <br>
                            </td>
                            <td>
                                @foreach($data->dependents()->get() as $item)
                                <a class="btn btn-link m-0 text-reset text-info h6 " href="/admin/membership/dependent/{{$item->referral_code ?? ''}}" target="_blank">{{ $item->last_name ?? '' }}, {{ $item->first_name ?? '' }} ({{ $item->middle_name ?? 'N/A' }}) - {{ $item->membership_type ?? '' }}</a> <br>
                                @endforeach
                            </td>
                            <td>
                                <strong>{{ $data->membership_type ?? '' }}</strong>

                            </td>
                            <td>
                                <div class="form-group">
                                    <select class="select2 form-control select_endorse_to" member="{{  $data->id ?? '' }} " style="width: 100%" value="{{$data->endorse_to}}">
                                        <option value="" disabled selected>Please select</option>
                                        <option value="BILLING" {{$data->endorse_to == 'BILLING' ? 'selected':''}}>BILLING</option>
                                        <option value="ACCOUNTING" {{$data->endorse_to == 'ACCOUNTING' ? 'selected':''}}>ACCOUNTING</option>
                                        <option value="MEMBER" {{$data->endorse_to == 'MEMBER' ? 'selected':''}}>MEMBER</option>
                                        <option value="MDA" {{$data->endorse_to == 'MDA' ? 'selected':''}}>MDA</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="badge badge-success h6">{{$data->status ?? ""}}</div>
                            </td>
                            <td>
                                <div class="badge badge-success h6">{{$data->statusUser ?? ""}}</div>
                            </td>
                            <td>
                                @foreach($data->activities()->latest()->paginate(1) as $act)
                                <div>• {{ $act->created_at->format('M j , Y h:i A') }} <br> • {{ $act->activity ?? '' }} </div> <br>

                                @endforeach
                            </td>
                            <td>
                                {{ $data->created_at->format('M j , Y h:i A') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

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
                            <div class="card border border-primary border-right-0 border-left-0 border-bottom-0 rounded">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <p class="fw-bold  text-dark h6">Account Name:</p>
                                    <p class="fw-bold  text-dark h6 account_name"> </p>
                                </div>
                            </div>
                            <div class="card border border-primary border-right-0 border-left-0 border-bottom-0 rounded">
                                <div class="card-body">
                                    <p class="fw-bold mb-1 text-dark h6">Sales Order</p>
                                    <div class="fw-bold text-primary text-uppercase quatation_uploaded_by"></div>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope=" h6">ITEM</th>

                                                <th scope=" h6">AMOUNT</th>
                                            </tr>
                                        </thead>
                                        <tbody id="principal_charge">

                                        </tbody>
                                        <tbody id="dependents_charge">

                                        </tbody>

                                        <tbody id="charge_section">

                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <td>

                                                </td>
                                                <td>

                                                </td>
                                                <td>

                                                </td>
                                            </tr>
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th>TOTAL</th>

                                                <th class="total">0</th>
                                            </tr>
                                        </tfoot>
                                        <tfoot>
                                            <tr>
                                                <th>SUBTOTAL</th>

                                                <th class="subtotal">0</th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <button type="button" class="btn btn-primary text-uppercase notify_member text-center float-right">Send to member</button>
                                    <div class="fw-bold text-primary text-uppercase float-right mt-3 mr-4 last_send_email_for_quatation"></div>
                                </div>

                            </div>
                            <div class="card border border-primary border-right-0 border-left-0 border-bottom-0 rounded payment_details_section">
                                <div class="card-body">
                                    <p class="fw-bold mb-1 text-dark h6">Payment Details</p>
                                    <div class="fw-bold text-primary text-uppercase approved_by_accounting"></div>
                                    <table class="table table-striped">

                                        <tbody id="receipt_data">

                                        </tbody>

                                    </table>
                                    <button type="button" class="btn btn-primary text-uppercase notify_member_payment text-center float-right">Send to member</button>
                                    <div class="fw-bold text-primary text-uppercase float-right mt-3 mr-4 last_send_email_for_payment"></div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>


                <input type="hidden" name="action" id="action" value="Add" />
                <input type="hidden" name="hidden_id" id="hidden_id" />
            </div>
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<div id="modalViewImage" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header ">
                <p class="modal-title  text-uppercase font-weight-bold">Uploaded Image</p>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <img alt="no file" id="img_file" class="img-responsive">
            </div>
        </div>
    </div>
</div>

<form method="post" id="ifgForm" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    <div class="modal" id="modalIFG" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered ">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header ">
                    <p class="modal-title  text-uppercase font-weight-bold">IFG Form</p>
                    <button type="button" class="close " data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body row">
                    <div class="col-xl-12 mb-4">
                        <div class="card " style="background: #e0e0e0;">
                            <div class="card-body">

                                <div class="card border border-primary border-right-0 border-left-0 border-bottom-0 rounded">
                                    <div class="card-body">
                                        <div class="row ">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Mem Count <span class="text-danger">*</span></label>
                                                    <input type="text" name="mem_count" id="mem_count" class="form-control" />
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="error-mem_count"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Account Type <span class="text-danger">*</span></label>
                                                    <select name="account_type" id="account_type" class="select2 form-control" style="width: 100%">
                                                        <option value="" selected="" disabled="">Select Account Type</option>
                                                        <option value="IFC">IFG- WITH COVID</option>
                                                        <option value="IFB">IFG-BUNDLED</option>
                                                        <option value="IFS">IFG-STANDARD</option>
                                                        <option value="IFV">IFG-VIP</option>
                                                    </select>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="error-account_type"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="name" id="name" class="form-control" />
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="error-name"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Billing Address <span class="text-danger">*</span></label>
                                                    <input type="text" name="billing_address" id="billing_address" class="form-control" />
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="error-billing_address"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">City, Province <span class="text-danger">*</span></label>
                                                    <select name="city_province" id="city_province" class="select2 form-control" style="width: 100%">
                                                        <option value="" selected="" disabled="">Select City/Province/Region</option>
                                                        <option value="1101">AGOO LA UNION I</option>
                                                        <option value="1060">ALAMINOS PANGASINAN I</option>
                                                        <option value="1084">ALFONSO (CAVITE) CAVITE IV-A </option>
                                                        <option value="914">ALICIA (ISABELA) ISABELA II</option>
                                                        <option value="1150">AMADEO CAVITE IV-A</option>
                                                        <option value="41">ANGELES CITY PAMPANGA III</option>
                                                        <option value="42">ANGONO RIZAL IV-A </option>
                                                        <option value="43">ANTIPOLO CITY RIZAL IV-A </option>
                                                        <option value="1066">APALIT PAMPANGA III</option>
                                                        <option value="925">APARRI CAGAYAN II</option>
                                                        <option value="1072">ARAYAT PAMPANGA III</option>
                                                        <option value="922">ASUNCION DAVAO DEL NORTE XI </option>
                                                        <option value="1008">ATIMONAN QUEZON IV-A </option>
                                                        <option value="1122">BACACAY ALBAY V</option>
                                                        <option value="1095">BACNOTAN (LA UNION) LA UNION I</option>
                                                        <option value="59">BACOLOD CITY NEGROS OCCIDENTAL VI</option>
                                                        <option value="1138">BACOLOR CITY PAMPANGA III</option>
                                                        <option value="62">BACOOR CAVITE IV-A </option>
                                                        <option value="997">BAGO CITY NEGROS OCCIDENTAL VI </option>
                                                        <option value="67">BAGUIO CITY BENGUET CAR </option>
                                                        <option value="1029">BALAGTAS BULACAN III</option>
                                                        <option value="974">BALANGA CITY BATAAN III</option>
                                                        <option value="1106">BALASAN ILOILO VI </option>
                                                        <option value="1059">BALAYAN BATANGAS IV-A </option>
                                                        <option value="933">BALER AURORA III</option>
                                                        <option value="1157">BALETE BATANGAS IV-A </option>
                                                        <option value="1030">BALIUAG BULACAN III</option>
                                                        <option value="890">BAMBAN TARLAC III</option>
                                                        <option value="905">BANAUE IFUGAO CAR </option>
                                                        <option value="901">BANGUED ABRA CAR </option>
                                                        <option value="909">BANTAY ILOCOS SUR I</option>
                                                        <option value="1139">BASA AIRBASE PAMPANGA III</option>
                                                        <option value="934">BASCO BATANES II</option>
                                                        <option value="1022">BATAC CITY ILOCOS NORTE I</option>
                                                        <option value="102">BATANGAS CITY BATANGAS IV-A </option>
                                                        <option value="900">BAUAN BATANGAS IV-A </option>
                                                        <option value="920">BAUTISTA PANGASINAN I</option>
                                                        <option value="1119">BAY LAGUNA IV-A</option>
                                                        <option value="1024">BAYAMBANG PANGASINAN I</option>
                                                        <option value="1097">BAYOMBONG NUEVA VIZCAYA II</option>
                                                        <option value="1092">BAYUGAN AGUSAN DEL SUR XIII </option>
                                                        <option value="1038">BAYUGAN CITY AGUSAN DEL SUR XIII </option>
                                                        <option value="1103">BINAKAYAN CAVITE IV-A </option>
                                                        <option value="116">BIÑAN CITY LAGUNA IV-A </option>
                                                        <option value="926">BINANGONAN RIZAL IV-A </option>
                                                        <option value="918">BISLIG CITY SURIGAO DEL SUR XIII </option>
                                                        <option value="951">BOAC MARINDUQUE IV-B </option>
                                                        <option value="121">BOCAUE BULACAN III</option>
                                                        <option value="733">BOGO CITY CEBU VII </option>
                                                        <option value="1099">BOLINAO PANGASINAN I</option>
                                                        <option value="967">BONGAO TAWI-TAWI ARMM </option>
                                                        <option value="955">BONTOC MOUNTAIN PROVINCE CAR </option>
                                                        <option value="1113">BROOKE'S POINT PALAWAN IV-B </option>
                                                        <option value="152">BUSTOS BULACAN III</option>
                                                        <option value="888">BUTUAN CITY AGUSAN DEL NORTE XIII </option>
                                                        <option value="155">BUUG ZAMBOANGA SIBUGAY IX </option>
                                                        <option value="929">CABADBARAN CITY AGUSAN DEL NORTE XIII </option>
                                                        <option value="158">CABANATUAN CITY NUEVA ECIJA III</option>
                                                        <option value="1104">CABUGAO ILOCOS SUR I</option>
                                                        <option value="947">CABUYAO (LAGUNA) LAGUNA IV-A </option>
                                                        <option value="999">CADIZ CITY NEGROS OCCIDENTAL VI </option>
                                                        <option value="165">CAGAYAN DE ORO CITY MISAMIS ORIENTAL X </option>
                                                        <option value="167">CAINTA RIZAL IV-A </option>
                                                        <option value="1102">CALACA BATANGAS IV-A </option>
                                                        <option value="170">CALAMBA CITY LAGUNA IV-A </option>
                                                        <option value="915">CALAPAN CITY ORIENTAL MINDORO IV-B </option>
                                                        <option value="174">CALASIAO PANGASINAN I</option>
                                                        <option value="1058">CALATAGAN BATANGAS IV-A </option>
                                                        <option value="1011">CALBAYOG CITY WESTERN SAMAR VIII </option>
                                                        <option value="181">CALOOCAN CITY METRO MANILA NCR </option>
                                                        <option value="1046">CALUMPIT BULACAN III</option>
                                                        <option value="972">CAMALIG (ALBAY) ALBAY V </option>
                                                        <option value="940">CAMIGUIN CAMIGUIN X </option>
                                                        <option value="1077">CAMILING TARLAC III</option>
                                                        <option value="1096">CANDABA PAMPANGA III</option>
                                                        <option value="186">CANDELARIA QUEZON IV-A </option>
                                                        <option value="188">CANDON CITY ILOCOS SUR I</option>
                                                        <option value="957">CANLAON CITY NEGROS ORIENTAL VII </option>
                                                        <option value="190">CAPAS TARLAC III</option>
                                                        <option value="1081">CARCAR CITY CEBU VII </option>
                                                        <option value="961">CARDONA RIZAL IV-A </option>
                                                        <option value="194">CARMONA CAVITE IV-A </option>
                                                        <option value="911">CATARMAN NORTHERN SAMAR VIII </option>
                                                        <option value="874">CATBALOGAN WESTERN SAMAR VIII </option>
                                                        <option value="899">CAUAYAN CITY ISABELA II</option>
                                                        <option value="1156">CAVINTI LAGUNA IV-A</option>
                                                        <option value="201">CAVITE CITY CAVITE IV-A </option>
                                                        <option value="980">CEBU CITY CEBU VII </option>
                                                        <option value="953">CLARIN MISAMIS OCCIDENTAL X </option>
                                                        <option value="1149">CLARK CITY PAMPANGA III</option>
                                                        <option value="942">COMPOSTELA VALLEY COMPOSTELA VALLEY XI </option>
                                                        <option value="1076">CONCEPCION (TARLAC) TARLAC III</option>
                                                        <option value="964">CONSOLACION CEBU VII </option>
                                                        <option value="959">CORON PALAWAN IV-B </option>
                                                        <option value="894">COTABATO CITY MAGUINDANAO XII </option>
                                                        <option value="1111">CULASI ANTIQUE VI </option>
                                                        <option value="994">DAET CAMARINES NORTE V </option>
                                                        <option value="895">DAGUPAN CITY PANGASINAN I</option>
                                                        <option value="1039">DALAGUETE CITY CEBU VII </option>
                                                        <option value="981">DANAO CITY CEBU VII </option>
                                                        <option value="1017">DAPITAN CITY ZAMBOANGA DEL NORTE IX </option>
                                                        <option value="1047">DARAGA ALBAY V </option>
                                                        <option value="222">DASMARIÑAS CITY CAVITE IV-A </option>
                                                        <option value="234">DAVAO CITY DAVAO DEL SUR XI </option>
                                                        <option value="987">DIGOS CITY DAVAO DEL SUR XI </option>
                                                        <option value="1057">DINALUPIHAN BATAAN III</option>
                                                        <option value="898">DIPOLOG CITY ZAMBOANGA DEL NORTE IX </option>
                                                        <option value="908">DUMAGUETE CITY NEGROS ORIENTAL VII </option>
                                                        <option value="944">EASTERN SAMAR EASTERN SAMAR VIII </option>
                                                        <option value="954">EL SALVADOR CITY MISAMIS ORIENTAL X </option>
                                                        <option value="1136">ENRILE CAGAYAN II</option>
                                                        <option value="1000">ESCALANTE CITY NEGROS OCCIDENTAL VI </option>
                                                        <option value="1091">ESTANCIA (ILOILO) ILOILO VI </option>
                                                        <option value="1114">FAMY LAGUNA IV-A </option>
                                                        <option value="1069">FLORIDABLANCA PAMPANGA III</option>
                                                        <option value="1005">GAPAN CITY NUEVA ECIJA III</option>
                                                        <option value="279">GENERAL SANTOS CITY SOUTH COTABATO XII </option>
                                                        <option value="1152">GENERAL TINIO NUEVA ECIJA III</option>
                                                        <option value="274">GENERAL TRIAS CAVITE IV-A </option>
                                                        <option value="1154">GERONA TARLAC III</option>
                                                        <option value="998">GINGOOG CITY MISAMIS ORIENTAL X </option>
                                                        <option value="1062">GMA CAVITE IV-A </option>
                                                        <option value="1068">GOA CAMARINES SUR V </option>
                                                        <option value="1065">GUAGUA PAMPANGA III</option>
                                                        <option value="1031">GUIGUINTO BULACAN III</option>
                                                        <option value="1123">GUINOBATAN ALBAY V</option>
                                                        <option value="1088">GUMACA QUEZON IV-A </option>
                                                        <option value="1075">HERMOSA BATAAN III</option>
                                                        <option value="1001">HIMAMAYLAN CITY NEGROS OCCIDENTAL VI </option>
                                                        <option value="301">IBA ZAMBALES III</option>
                                                        <option value="1054">IBAAN BATANGAS IV-A </option>
                                                        <option value="1028">ILAGAN CITY ISABELA II</option>
                                                        <option value="305">ILIGAN CITY LANAO DEL NORTE X </option>
                                                        <option value="990">ILOILO CITY ILOILO VI </option>
                                                        <option value="308">IMUS CAVITE IV-A </option>
                                                        <option value="1061">INDANG CAVITE IV-A </option>
                                                        <option value="1019">IPIL ZAMBOANGA SIBUGAY IX </option>
                                                        <option value="977">IRIGA CITY CAMARINES SUR V </option>
                                                        <option value="1089">ISABELA (NEGROS OCC.) NEGROS OCCIDENTAL VI </option>
                                                        <option value="910">ISABELA CITY BASILAN ARMM </option>
                                                        <option value="1064">JAEN NUEVA ECIJA III</option>
                                                        <option value="938">JAGNA BOHOL VII </option>
                                                        <option value="945">JORDAN GUIMARAS VI </option>
                                                        <option value="1080">JOSE PANGANIBAN CAMARINES NORTE V </option>
                                                        <option value="1124">JOVELLAR ALBAY V</option>
                                                        <option value="1083">KABACAN NORTH COTABATO XII </option>
                                                        <option value="1002">KABANKALAN CITY NEGROS OCCIDENTAL VI </option>
                                                        <option value="932">KABUGAO APAYAO CAR </option>
                                                        <option value="969">KALAWIT ZAMBOANGA DEL NORTE IX </option>
                                                        <option value="880">KALIBO AKLAN VI </option>
                                                        <option value="1074">KAWIT CAVITE IV-A </option>
                                                        <option value="984">KIDAPAWAN CITY NORTH COTABATO XII </option>
                                                        <option value="1013">KORONADAL CITY SOUTH COTABATO XII </option>
                                                        <option value="1003">LA CARLOTA CITY NEGROS OCCIDENTAL VI </option>
                                                        <option value="1027">LA TRINIDAD BENGUET CAR </option>
                                                        <option value="948">LANAO DEL NORTE LANAO DEL NORTE X </option>
                                                        <option value="949">LANAO DEL SUR LANAO DEL SUR ARMM </option>
                                                        <option value="988">LAOAG CITY ILOCOS NORTE I</option>
                                                        <option value="916">LAPU-LAPU CITY CEBU VII </option>
                                                        <option value="367">LAS PIÑAS CITY METRO MANILA NCR </option>
                                                        <option value="877">LEGAZPI CITY ALBAY V </option>
                                                        <option value="1055">LEMERY BATANGAS IV-A </option>
                                                        <option value="892">LEYTE LEYTE VIII </option>
                                                        <option value="1125">LIBON ALBAY V</option>
                                                        <option value="971">LIGAO CITY ALBAY V </option>
                                                        <option value="1041">LINGAYEN PANGASINAN I</option>
                                                        <option value="1105">LINGSAT LA UNION I</option>
                                                        <option value="382">LIPA CITY BATANGAS IV-A </option>
                                                        <option value="387">LOPEZ (QUEZON) QUEZON IV-A </option>
                                                        <option value="388">LOS BAÑOS LAGUNA IV-A </option>
                                                        <option value="1070">LUBAO PAMPANGA III</option>
                                                        <option value="394">LUCENA CITY QUEZON IV-A </option>
                                                        <option value="1014">MAASIN CITY SOUTHERN LEYTE VIII </option>
                                                        <option value="407">MABALACAT PAMPANGA III</option>
                                                        <option value="1052">MABINI BATANGAS IV-A </option>
                                                        <option value="1140">MACABEBE PAMPANGA III</option>
                                                        <option value="1109">MAGALANG PAMPANGA III</option>
                                                        <option value="897">MAGSAYSAY DAVAO DEL SUR XI </option>
                                                        <option value="430">MAKATI CITY METRO MANILA NCR </option>
                                                        <option value="1107">MAKILALA COTABATO XII </option>
                                                        <option value="432">MALABON CITY METRO MANILA NCR </option>
                                                        <option value="1098">MALALAG DAVAO DEL SUR XI </option>
                                                        <option value="1040">MALAY AKLAN VI </option>
                                                        <option value="793">MALAYBALAY CITY BUKIDNON X </option>
                                                        <option value="1126">MALILIPOT ALBAY V</option>
                                                        <option value="1127">MALINAO ALBAY V</option>
                                                        <option value="437">MALOLOS CITY BULACAN III</option>
                                                        <option value="1153">MALVAR BATANGAS IV-A</option>
                                                        <option value="444">MANDALUYONG CITY METRO MANILA NCR </option>
                                                        <option value="885">MANDAUE CITY CEBU VII </option>
                                                        <option value="448">MANILA CITY METRO MANILA NCR </option>
                                                        <option value="1128">MANITO ALBAY V</option>
                                                        <option value="1100">MANOLO FORTICH BUKIDNON X </option>
                                                        <option value="1063">MARAGONDON CAVITE IV-A </option>
                                                        <option value="1050">MARAMAG BUKIDNON X </option>
                                                        <option value="992">MARAWI CITY LANAO DEL SUR ARMM </option>
                                                        <option value="460">MARIKINA CITY METRO MANILA NCR </option>
                                                        <option value="1032">MARILAO BULACAN III</option>
                                                        <option value="1045">MARIVELES BATAAN III</option>
                                                        <option value="1141">MASANTOL PAMPANGA III</option>
                                                        <option value="952">MASBATE CITY MASBATE V </option>
                                                        <option value="968">MASINLOC ZAMBALES III</option>
                                                        <option value="1042">MATI CITY (DAVAO ORIENTAL) DAVAO ORIENTAL XI </option>
                                                        <option value="1085">MENDEZ CAVITE IV-A </option>
                                                        <option value="473">MEXICO PAMPANGA III</option>
                                                        <option value="975">MEYCAUAYAN CITY BULACAN III</option>
                                                        <option value="928">MIDSAYAP NORTH COTABATO XII </option>
                                                        <option value="1142">MINALIN PAMPANGA III</option>
                                                        <option value="1115">MOLAVE ZAMBOANGA DEL SUR IX </option>
                                                        <option value="1159">MONTALBAN RIZAL IV-A</option>
                                                        <option value="919">MORONG RIZAL IV-A </option>
                                                        <option value="1118">MUNICIPALITY OF BAY LAGUNA IV-A</option>
                                                        <option value="484">MUNTINLUPA CITY METRO MANILA NCR </option>
                                                        <option value="1120">NABUA CAMARINES SUR V</option>
                                                        <option value="486">NAGA CITY CAMARINES SUR V </option>
                                                        <option value="1086">NAIC CAVITE IV-A </option>
                                                        <option value="1056">NASUGBU BATANGAS IV-A </option>
                                                        <option value="937">NAVAL BILIRAN VIII </option>
                                                        <option value="970">NAVOTAS CITY METRO MANILA NCR </option>
                                                        <option value="141">NORZAGARAY BULACAN III</option>
                                                        <option value="883">NOVELETA CAVITE IV-A </option>
                                                        <option value="1129">OAS ALBAY V</option>
                                                        <option value="1133">OBANDO BULACAN III</option>
                                                        <option value="962">ODIONGAN ROMBLON IV-B </option>
                                                        <option value="873">OLONGAPO CITY ZAMBALES III</option>
                                                        <option value="882">ORION BATAAN III</option>
                                                        <option value="993">ORMOC CITY LEYTE VIII </option>
                                                        <option value="995">OROQUIETA CITY MISAMIS OCCIDENTAL X </option>
                                                        <option value="1090">OTON ILOILO VI </option>
                                                        <option value="902">OZAMIZ CITY MISAMIS OCCIDENTAL X </option>
                                                        <option value="1094">PADRE GARCIA BATANGAS IV-A </option>
                                                        <option value="886">PAGADIAN CITY ZAMBOANGA DEL SUR IX </option>
                                                        <option value="1087">PAGBILAO QUEZON IV-A </option>
                                                        <option value="891">PAGSANJAN (LAGUNA) LAGUNA IV-A </option>
                                                        <option value="985">PANABO CITY DAVAO DEL NORTE XI </option>
                                                        <option value="191">PANAY (CAPIZ) CAPIZ VI </option>
                                                        <option value="1037">PAOMBONG (BULACAN) BULACAN III</option>
                                                        <option value="547">PARANAQUE CITY METRO MANILA NCR </option>
                                                        <option value="950">PARANG (MAGUINDANAO) MAGUINDANAO ARMM </option>
                                                        <option value="550">PASAY CITY METRO MANILA NCR </option>
                                                        <option value="551">PASIG CITY METRO MANILA NCR </option>
                                                        <option value="991">PASSI CITY (ILOILO) ILOILO VI </option>
                                                        <option value="1044">PATEROS METRO MANILA NCR </option>
                                                        <option value="939">PILI CAMARINES SUR V </option>
                                                        <option value="1134">PILILLA RIZAL IV-A</option>
                                                        <option value="1067">PINAMALAYAN OCCIDENTAL MINDORO IV-B </option>
                                                        <option value="1048">PIODURAN ALBAY V </option>
                                                        <option value="1035">PLARIDEL BULACAN III</option>
                                                        <option value="1121">POLANGUI ALBAY V</option>
                                                        <option value="1143">PORAC PAMPANGA III</option>
                                                        <option value="1158">POZORRUBIO PANGASINAN I</option>
                                                        <option value="930">PROSPERIDAD, AGUSAN DEL SUR AGUSAN DEL SUR XIII </option>
                                                        <option value="1007">PUERTO GALERA ORIENTAL MINDORO IV-B </option>
                                                        <option value="590">PUERTO PRINCESA CITY PALAWAN IV-B </option>
                                                        <option value="1034">PULILAN BULACAN III</option>
                                                        <option value="879">QUEZON (BUKIDNON) BUKIDNON X </option>
                                                        <option value="599">QUEZON CITY METRO MANILA NCR </option>
                                                        <option value="960">QUIRINO QUIRINO II</option>
                                                        <option value="1130">RAPU-RAPU ALBAY V</option>
                                                        <option value="907">RODRIGUEZ (MONTALBAN,RIZAL) RIZAL IV-A </option>
                                                        <option value="1025">ROSALES PANGASINAN I</option>
                                                        <option value="921">ROSARIO (BATANGAS) BATANGAS IV-A </option>
                                                        <option value="619">ROSARIO (CAVITE) CAVITE IV-A </option>
                                                        <option value="978">ROXAS CITY CAPIZ VI </option>
                                                        <option value="1004">SAGAY CITY NEGROS OCCIDENTAL VI </option>
                                                        <option value="986">SAMAL CITY DAVAO DEL NORTE XI </option>
                                                        <option value="924">SAN CARLOS CITY NEGROS OCCIDENTAL VI </option>
                                                        <option value="1026">SAN CARLOS CITY (PANGASINAN) PANGASINAN I</option>
                                                        <option value="348">SAN FERNANDO CITY (LA UNION) LA UNION I</option>
                                                        <option value="927">SAN FERNANDO CITY (PAMPANGA) PAMPANGA III</option>
                                                        <option value="1116">SAN FRANCISCO AGUSAN DEL SUR XIII</option>
                                                        <option value="1051">SAN ILDEFONSO BULACAN III</option>
                                                        <option value="931">SAN JOSE (ANTIQUE) ANTIQUE VI </option>
                                                        <option value="1093">SAN JOSE (BATANGAS) BATANGAS IV-A </option>
                                                        <option value="1078">SAN JOSE (OCC. MINDORO) OCCIDENTAL MINDORO IV-B </option>
                                                        <option value="1006">SAN JOSE CITY (NUEVA ECIJA) NUEVA ECIJA III</option>
                                                        <option value="976">SAN JOSE DEL MONTE CITY BULACAN III</option>
                                                        <option value="672">SAN JUAN CITY METRO MANILA NCR </option>
                                                        <option value="904">SAN LEONARDO NUEVA ECIJA III</option>
                                                        <option value="1144">SAN LUIS PAMPANGA III</option>
                                                        <option value="681">SAN MATEO (RIZAL) RIZAL IV-A </option>
                                                        <option value="1033">SAN MIGUEL (BULACAN) BULACAN III</option>
                                                        <option value="1023">SAN NICOLAS ILOCOS NORTE I</option>
                                                        <option value="893">SAN PABLO CITY LAGUNA IV-A </option>
                                                        <option value="1108">SAN PASCUAL (BATANGAS) BATANGAS IV-A </option>
                                                        <option value="692">SAN PEDRO (LAGUNA) LAGUNA IV-A </option>
                                                        <option value="1135">SAN RAFAEL BULACAN III</option>
                                                        <option value="1145">SAN SIMON PAMPANGA III</option>
                                                        <option value="1147">SANTA ANA PAMPANGA III</option>
                                                        <option value="1073">SANTA ANA (CAGAYAN) CAGAYAN II</option>
                                                        <option value="912">SANTA CRUZ (LAGUNA) LAGUNA IV-A </option>
                                                        <option value="958">SANTA CRUZ (OCC. MINDORO) OCCIDENTAL MINDORO IV-B </option>
                                                        <option value="1148">SANTA RITA PAMPANGA III</option>
                                                        <option value="728">SANTA ROSA CITY LAGUNA IV-A </option>
                                                        <option value="889">SANTIAGO CITY ISABELA II</option>
                                                        <option value="1131">SANTO DOMINGO (LIBOG) ALBAY V</option>
                                                        <option value="906">SARIAYA QUEZON IV-A </option>
                                                        <option value="1146">SEXMOAN PAMPANGA III</option>
                                                        <option value="1071">SIGMA, CAPIZ CAPIZ VI </option>
                                                        <option value="759">SILANG (CAVITE) CAVITE IV-A </option>
                                                        <option value="956">SILAY CITY NEGROS OCCIDENTAL VI </option>
                                                        <option value="1110">SINAIT ILOCOS SUR I</option>
                                                        <option value="1049">SINILOAN LAGUNA IV-A </option>
                                                        <option value="963">SIQUIJOR SIQUIJOR VII </option>
                                                        <option value="965">SOGOD SOUTHERN LEYTE VIII </option>
                                                        <option value="923">SOLANO NUEVA VIZCAYA II</option>
                                                        <option value="1012">SORSOGON CITY SORSOGON V </option>
                                                        <option value="306">STA. BARBARA (ILOILO) ILOILO VI </option>
                                                        <option value="876">STA. ELENA CAMARINES NORTE V </option>
                                                        <option value="1036">STA. MARIA (BULACAN) BULACAN III</option>
                                                        <option value="1043">STO. TOMAS (BATANGAS) BATANGAS IV-A </option>
                                                        <option value="917">STO. TOMAS (PAMPANGA) PAMPANGA III</option>
                                                        <option value="778">SUBIC (ZAMBALES) ZAMBALES III</option>
                                                        <option value="881">SURALLAH SOUTH COTABATO XII </option>
                                                        <option value="1015">SURIGAO CITY SURIGAO DEL NORTE XIII </option>
                                                        <option value="1112">TAAL BATANGAS IV-A </option>
                                                        <option value="878">TABACO CITY (ALBAY) ALBAY V </option>
                                                        <option value="946">TABUK CITY KALINGA CAR </option>
                                                        <option value="875">TACLOBAN CITY LEYTE VIII </option>
                                                        <option value="782">TACURONG SULTAN KUDARAT XII </option>
                                                        <option value="792">TAGAYTAY CITY CAVITE IV-A </option>
                                                        <option value="887">TAGBILARAN CITY BOHOL VII </option>
                                                        <option value="795">TAGOLOAN MISAMIS ORIENTAL X </option>
                                                        <option value="797">TAGUIG CITY METRO MANILA NCR </option>
                                                        <option value="798">TAGUM CITY DAVAO DEL NORTE XI </option>
                                                        <option value="1155">TALISAY (BATANGAS) BATANGAS IV-A</option>
                                                        <option value="1018">TALISAY CITY (CEBU) CEBU VII </option>
                                                        <option value="982">TALISAY CITY (NEGROS OCC.) NEGROS OCCIDENTAL VI </option>
                                                        <option value="896">TANAUAN CITY BATANGAS IV-A </option>
                                                        <option value="810">TANAY RIZAL IV-A</option>
                                                        <option value="966">TANDAG SURIGAO DEL SUR XIII </option>
                                                        <option value="996">TANGUB CITY MISAMIS OCCIDENTAL X </option>
                                                        <option value="813">TANZA CAVITE IV-A </option>
                                                        <option value="1016">TARLAC CITY TARLAC III</option>
                                                        <option value="1117">TAYABAS CITY QUEZON IV-A</option>
                                                        <option value="820">TAYTAY RIZAL IV-A </option>
                                                        <option value="1053">TAYUG PANGASINAN I</option>
                                                        <option value="1079">TERESA RIZAL IV-A </option>
                                                        <option value="1137">TERNATE CAVITE IV-A</option>
                                                        <option value="868">TIGBAO ZAMBOANGA DEL SUR IX </option>
                                                        <option value="1132">TIWI ALBAY V</option>
                                                        <option value="983">TOLEDO CITY CEBU VII </option>
                                                        <option value="979">TRECE MARTIRES CITY CAVITE IV-A </option>
                                                        <option value="843">TUGUEGARAO CITY CAGAYAN II</option>
                                                        <option value="943">TULUNAN NORTH COTABATO XII </option>
                                                        <option value="1082">TUPI SOUTH COTABATO XII </option>
                                                        <option value="1010">URDANETA CITY PANGASINAN I</option>
                                                        <option value="913">VALENCIA CITY BUKIDNON X </option>
                                                        <option value="857">VALENZUELA CITY METRO MANILA NCR </option>
                                                        <option value="989">VIGAN CITY ILOCOS SUR I</option>
                                                        <option value="941">VIRAC CATANDUANES V </option>
                                                        <option value="869">ZAMBOANGA CITY ZAMBOANGA DEL SUR IX </option>
                                                    </select>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="error-city_province"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Contact Number</label>
                                                    <input type="text" name="contact_number" id="contact_number" class="form-control" />
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="error-contact_number"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Request By <span class="text-danger">*</span></label>
                                                    <input type="text" name="request_by" id="request_by" class="form-control" />
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="error-request_by"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Department <span class="text-danger">*</span></label>
                                                    <input type="text" name="department" id="department" class="form-control" />
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="error-department"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Business Source <span class="text-danger">*</span></label>
                                                    <select name="business_source" id="business_source" class="select2 form-control" style="width: 100%">
                                                        <option value="" selected="" disabled="">Select Business Source</option>
                                                        <option value="A">Agent</option>
                                                        <option value="B">Broker</option>
                                                        <option value="D">Direct</option>
                                                    </select>

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="error-business_source"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Direct <span class="text-danger">*</span></label>
                                                    <select name="direct" id="direct" class="select2 form-control" style="width: 100%">
                                                        <option value="" selected="" disabled="">Select Direct</option>
                                                        <option value="A">Agent</option>
                                                        <option value="B">Broker</option>
                                                        <option value="D">Direct</option>
                                                    </select>

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="error-direct"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Name Of Business <span class="text-danger">*</span></label>
                                                    <select name="name_of_business" id="name_of_business" class="select2 form-control" style="width: 100%">
                                                        <option value="" selected="" disabled="">Select Name Of Business</option>
                                                        <option value="VAG21123102">AARON KEVIN ROIE B. RANGASAJO</option>
                                                        <option value="VAG11010601">ADONNA GARCIA YABUT</option>
                                                        <option value="VAG11072078">ADRIAN CONCEPCION DAPAT</option>
                                                        <option value="VAG19072277">AGNES F. SIY</option>
                                                        <option value="VAG02010347">AIDA PAUBSANON COSTALES</option>
                                                        <option value="VAG15111244">AILEEN A. PIDLAOAN</option>
                                                        <option value="VAG11071563">AILEEN VALDEZ TERRENCIO</option>
                                                        <option value="VAG15020606">AILYN FRANCISCO</option>
                                                        <option value="VAG12021778">ALBERT JOHN ART KASILAG RABAGO</option>
                                                        <option value="VAG15020662">ALBERTO BONIFACIO</option>
                                                        <option value="VAG12012061">ALBERTO BORNILLA ORILLAZA "BERT"</option>
                                                        <option value="VAG12042765">ALEJANDRO C. DE GUZMAN</option>
                                                        <option value="VAG11010584">ALEJANDRO OCTAVIO GUILLERME JR.</option>
                                                        <option value="VAG21123218">ALEX P. TOLENTINO</option>
                                                        <option value="VAG15111211">Alexander M. Bongat</option>
                                                        <option value="VAG11021828">ALEXANDER R. CORDERO</option>
                                                        <option value="VAG21123101">ALEXIS O. ARCON</option>
                                                        <option value="VAG14082771">ALICE M. GARIN</option>
                                                        <option value="VAG14091772">ALICIA E. TEOPIZ</option>
                                                        <option value="VAG02010308">ALICIA P. SANTIBANEZ</option>
                                                        <option value="VAG11051808">ALICIA SERRANO</option>
                                                        <option value="VAG11010691">ALICIA YANG TO</option>
                                                        <option value="VAG11010697">ALLAN GUEVARRA UNSON</option>
                                                        <option value="VAG21123208">ALLAN O. DE LUNA</option>
                                                        <option value="VAG21123104">ALMA A. BERNABE</option>
                                                        <option value="VAG21123134">ALYSSA MARIE S. GARCIA</option>
                                                        <option value="VAG11010687">AMADEO V. GERA</option>
                                                        <option value="VAG16080920">AMALIA TAGANAS</option>
                                                        <option value="VAG21072202">Amanda B. Garcia</option>
                                                        <option value="VAG15020675">AMANDA TAN</option>
                                                        <option value="VAG21123231">AMBROCIO P. CAPULONG II</option>
                                                        <option value="VAG16112536">AMELIA C. RAVIZ</option>
                                                        <option value="VAG11010699">AMELIA DELA CRUZ DIMLA</option>
                                                        <option value="VAG12022133">AMPARO P. MIRADOR</option>
                                                        <option value="VAG11010538">ANA CECILIA C. RAYNON</option>
                                                        <option value="VAG17022450">ANA LORRAINE PASION</option>
                                                        <option value="VAG02010340">ANA RUPERTA ORTALIZ TECSON</option>
                                                        <option value="VAG11062940">ANABELLA M. FABIAN</option>
                                                        <option value="VAG11010502">ANALIZA D. CORVERA</option>
                                                        <option value="VAG21123034">ANALIZA K. ZARA</option>
                                                        <option value="VAG19082343">ANALYN F. GARCIA</option>
                                                        <option value="VAG17021028">ANASTACIA DELOS REYES</option>
                                                        <option value="VAG02010328">ANDREW C ELA</option>
                                                        <option value="VAG14021138">Andrew Joseph R. Villaran</option>
                                                        <option value="VAG15020682">ANDY DE GUZMAN</option>
                                                        <option value="VAG18091196">ANGEL R. TIMOSA</option>
                                                        <option value="VAG18071941">ANGEL RITA TIMOSA</option>
                                                        <option value="VAG11010669">ANGELINA BERSABE REYES</option>
                                                        <option value="VAG17060272">ANGELINA DE FELIX</option>
                                                        <option value="VAG02010304">ANGELINA MANALO DUNGCA</option>
                                                        <option value="VAG15111275">ANGELINE M. AYALA</option>
                                                        <option value="VAG11010585">ANGELITA LOPEZ CHIJA</option>
                                                        <option value="VAG14111212">ANGELO MIGUEL C. APOLONIO</option>
                                                        <option value="VAG21123048">ANGELYN T. NEPOMUCENO</option>
                                                        <option value="VAG11010588">ANITA H. GOMEZ</option>
                                                        <option value="VAG12102233">ANITA S. CAYANAN</option>
                                                        <option value="VAG11010692">ANITA SAGUN CAYANAN</option>
                                                        <option value="VAG11011051">ANJANETTE I. CAMMAYO</option>
                                                        <option value="VAG17032964">ANNA LIZA RABO</option>
                                                        <option value="VAG13021806">ANNA LOURDES BONITA CRUZ</option>
                                                        <option value="VAG21123088">ANNA MARIE ELLORIN</option>
                                                        <option value="VAG15111208">Anna Regina B. Dela Victoria</option>
                                                        <option value="VAG15071419">ANNA VANESSA ABEGAIL COLLADO ENCARNACION</option>
                                                        <option value="VAG21123153">ANNA VANNESSA ABEGAIL C. ENCARNACION</option>
                                                        <option value="VAG21123175">ANNA VANNESSA ABEGAIL COLLADO ENCARNACION</option>
                                                        <option value="VAG12102266">ANNABEL P. SHEPHERD</option>
                                                        <option value="VAG15020607">ANNE CHUA</option>
                                                        <option value="VAG11051845">ANTONIETO CATIIL JR.</option>
                                                        <option value="VAG12120795">ANTONIO J. TAN</option>
                                                        <option value="VAG17012477">ANTONIO MERCADO</option>
                                                        <option value="VAG17080159">ANTONIO MIGUEL SANCHEZ JR.</option>
                                                        <option value="VAG16112577">ANTONIO O. ROMAN JR.</option>
                                                        <option value="VAG11010551">ANTONIO S. GERVACIO III</option>
                                                        <option value="VAG11010504">ARACELI AGLIDAY MANALASTAS</option>
                                                        <option value="VAG11010621">ARACELI TAN CABIGAO</option>
                                                        <option value="VAG17021070">ARCELI BONGAO</option>
                                                        <option value="VAG17052510">ARIEL BLANCAFLOR</option>
                                                        <option value="VAG02010376">ARLENE ILAGAN BEJASA</option>
                                                        <option value="VAG18091179">ARLENE M. BULAN</option>
                                                        <option value="VAG02010327">ARLETA SAMPARADA DELAS LLAGAS</option>
                                                        <option value="VAG11010684">ARMIDA ALMAZORA MAGNAYE</option>
                                                        <option value="VAG12060818">ARMIE ORTIZ PAZ</option>
                                                        <option value="VAG14102213">ARNOLD S. HERMANO</option>
                                                        <option value="VAG13101133">ARNOLD TORRES</option>
                                                        <option value="VAG17013001">ARSELINA CORAL</option>
                                                        <option value="VAG12052960">ARTURO M. VITANGCOL</option>
                                                        <option value="VAG02010378">ASUNCION PALMA BORDONES</option>
                                                        <option value="VAG11010505">ASUNCION U. NATIVIDAD</option>
                                                        <option value="VAG20012304">ATHENA ALEXANDRA O. KHU</option>
                                                        <option value="VAG11010639">AUGUSTO B. IBEA</option>
                                                        <option value="VAG11010543">AUREA JOSEFINA SALMO ANCHETA</option>
                                                        <option value="VAG11010572">AURORA A. BERONILLA</option>
                                                        <option value="VAG11011010">AURORA GERVACIO TABUTON</option>
                                                        <option value="VAG17041095">AVELETH ALBARRACIN</option>
                                                        <option value="VAG13120281">AVELINA D. MENDOZA</option>
                                                        <option value="VAG16053049">AVITA MONTES ORARA</option>
                                                        <option value="VAG11101767">AVITA MONTES ORARA</option>
                                                        <option value="VAG17060218">BELINDA LAGUMBAY</option>
                                                        <option value="VAG21123000">BELLY D. BERGANTINOS</option>
                                                        <option value="VAG13021847">BENJAMIN L. BUENAVENTURA</option>
                                                        <option value="VAG21123223">BENJAMIN O. CHUA JR.</option>
                                                        <option value="VAG21123176">BERNARD CHIU</option>
                                                        <option value="VAG11071503">BERNARDA BERTHITA VILLANUEVA LIWANAG</option>
                                                        <option value="VAG17021009">BERNARDITA GOYENA</option>
                                                        <option value="VAG12102257">BERNARDO T. ARRIOLA</option>
                                                        <option value="VAG19053169">BHABYCEL S. ROMERO</option>
                                                        <option value="VAG19062563">BIANCA VIEN V. BLANDO</option>
                                                        <option value="VAG11010643">BIENVENIDO BERNARDO ABELLA III</option>
                                                        <option value="VAG17012423">BILLE CRISTIANE T. TEMANEL</option>
                                                        <option value="VAG11020334">BLUECARE MARKETING SERVICES</option>
                                                        <option value="VAG11081539">BRENDA CADIENTE VALENZUELA</option>
                                                        <option value="VAG11020351">BRIGITTE B. SIBULO</option>
                                                        <option value="VAG15020693">BUENAVENTURA AGUILAR</option>
                                                        <option value="VAG11010534">CANDICE E. GOTANGCO</option>
                                                        <option value="VAG15111274">Carina V. Mariano</option>
                                                        <option value="VAG21082502">CARL VINCENT TABUG</option>
                                                        <option value="VAG17012438">CARLO ARCILLA</option>
                                                        <option value="VAG11012148">CARLOMAGNO P. FERNANDO</option>
                                                        <option value="VAG02010312">CARLOS ASPIRACION MONTON</option>
                                                        <option value="VAG15020656">CARLOS LAPIRA</option>
                                                        <option value="VAG21123130">CARMELA P. VULLAG </option>
                                                        <option value="VAG11092682">CARMELA R. PORTENTO</option>
                                                        <option value="VAG11092610">CARMELA ROSAS PORTENTO</option>
                                                        <option value="VAG18100410">CARMELITA CANLAS</option>
                                                        <option value="VAG19120301">CARMELITA L. ANDANAR</option>
                                                        <option value="VAG21123143">CARMELITA Q. DE VERA</option>
                                                        <option value="VAG15020664">CARMEN Z. FERRER</option>
                                                        <option value="VAG15042194">CAROL R. LADIGOHON</option>
                                                        <option value="VAG17022484">CAROLINA CABANA</option>
                                                        <option value="VAG11032562">CAROLINA G. UY</option>
                                                        <option value="VAG11010580">CAROLYN D. SUPLIDO</option>
                                                        <option value="VAG17012466">CATALINO T. BUNIEL III</option>
                                                        <option value="VAG16080814">CATHERINE CUNANAN</option>
                                                        <option value="VAG11010544">CATHERINE E. UBALDE</option>
                                                        <option value="VAG21123080">CATHERINE G. CALVERO</option>
                                                        <option value="VAG21123094">CATHERINE G. CALVERO</option>
                                                        <option value="VAG16053037">CECILIA ABLAZA NICOLAS</option>
                                                        <option value="VAG02010313">CECILIA CABURNIDA FAMY</option>
                                                        <option value="VAG11010553">CECILIA L. ACLAN</option>
                                                        <option value="VAG15100683">CECILIA M. LEE</option>
                                                        <option value="VAG11081506">CECILIA SABIO ORDO�EZ</option>
                                                        <option value="VAG11010533">CELIA TOMENIO SABELINO</option>
                                                        <option value="VAG11010655">CESAR JADEAR RODRIGUEZ</option>
                                                        <option value="VAG21123168">CESAR JOHN ARCE</option>
                                                        <option value="VAG17032906">CHARITO GINETE</option>
                                                        <option value="VAG21123184">CHARLENE C. PACOT</option>
                                                        <option value="VAG19072218">CHARLES F. LAGAMAYO</option>
                                                        <option value="VAG10093052">CHARLES VINCENT LIM</option>
                                                        <option value="VAG16080566">CHARLIE MACATANGAY</option>
                                                        <option value="VAG15020658">CHARLIE TAN</option>
                                                        <option value="VAG21123150">CHARMAINE JOY S. HERNANDEZ</option>
                                                        <option value="VAG21123234">CHAT PAULEEN C. VILLANUEVA</option>
                                                        <option value="VAG14081923">CHERRIE LYN P. ARCIO</option>
                                                        <option value="VAG13120227">CHERRY C. CASTILLO</option>
                                                        <option value="VAG02010360">CHERYL AURELIO BAOAYAN</option>
                                                        <option value="VAG11010660">CHERYL VIZCAYA MOYA</option>
                                                        <option value="VAG21123105">Chester A. Costinar</option>
                                                        <option value="VAG13021835">CHONA C. BRIONES</option>
                                                        <option value="VAG14110582">CHONA PILLENA</option>
                                                        <option value="VAG11022235">CHRISTIAN MARK E. MAGNAYE</option>
                                                        <option value="VAG12031623">CHRISTIE LLANES DAVID</option>
                                                        <option value="VAG21080204">Christopher Ursonal</option>
                                                        <option value="VAG12080174">CIELITO C. ESCUETA</option>
                                                        <option value="VAG15041743">CLARIVEL B. NAGAR</option>
                                                        <option value="VAG16112589">CONCHITA ANG CHEN</option>
                                                        <option value="VAG11020350">CONSOLACION HANOPOL</option>
                                                        <option value="VAG17060268">CONSUELO FERNANDEZ</option>
                                                        <option value="VAG02010377">CORAZON ACUZAR MAGTIBAY</option>
                                                        <option value="VAG12051567">CORAZON G. SANTOS</option>
                                                        <option value="VAG16112563">CREALIN M. AVENIDO</option>
                                                        <option value="VAG11020369">CRESCENT HEALTHCARE MARKETING</option>
                                                        <option value="VAG21123216">CRIS IRVIN LEDESMA VILLAPANDO</option>
                                                        <option value="VAG11120518">CRISPINA MARTINEZ VILLANUEVA</option>
                                                        <option value="VAG14081974">CRISTIELYN A. RAMOS</option>
                                                        <option value="VAG02010332">CRISTINA BARILEA DEUNA</option>
                                                        <option value="VAG18011639">CRISTINA G. NIEVES</option>
                                                        <option value="VAG11010647">CRISTINA KENNIKER VIRAY</option>
                                                        <option value="VAG11062734">CYNTHIA ZAMORA DELOS REYES</option>
                                                        <option value="VAG21041472">D�LAARNI A. ORTIZ</option>
                                                        <option value="VAG19082352">DALE M. DETALLA</option>
                                                        <option value="VAG21123232">DANIEL C. DE LEON</option>
                                                        <option value="VAG18091358">DANILO B. DELA CRUZ</option>
                                                        <option value="VAG21123214">DANILO S. CUSTODIO JR.</option>
                                                        <option value="VAG11071540">DAVID BELTRAN ESPINA</option>
                                                        <option value="VAG11081125">DBM HEALTHCARE , INC.</option>
                                                        <option value="VAG14112476">DEAN F. BAUTISTA</option>
                                                        <option value="VAG21123180">DEBORAH CHEYENNE V. GONZALES</option>
                                                        <option value="VAG17060244">DELIA SANDOVAL</option>
                                                        <option value="VAG12122645">DELIA STA. RITA LUCIANO</option>
                                                        <option value="VAG21123125">Delita N. Balante</option>
                                                        <option value="VAG02010307">DEMETRIA SALAZAR GARCIA</option>
                                                        <option value="VAG20061536">DESIREE MAE SAN MIGUEL</option>
                                                        <option value="VAG11010673">DIANA CRUZ SOTO</option>
                                                        <option value="VAG17080197">DITAS P. GIRON</option>
                                                        <option value="VAG11010571">DIVINA D. REYES</option>
                                                        <option value="VAG15020622">DIVINA FUENTES</option>
                                                        <option value="VAG14060970">DIVINIA A. SEGUI</option>
                                                        <option value="VAG11081159">DOLORES ALIX BAUTISTA</option>
                                                        <option value="VAG17012450">DOLORES BANIEL</option>
                                                        <option value="VAG18091198">DOLORES ELENA B. AMOLAR</option>
                                                        <option value="VAG11010554">DOLORES I. SACRO</option>
                                                        <option value="VAG15020683">DOROTHY JANE ONG</option>
                                                        <option value="VAG11010568">DOROTHY P. SULLERA</option>
                                                        <option value="VAG16102456">DWIGHT EMERSON G. MATIAS</option>
                                                        <option value="VAG21123165">EARL WILLIAM TAN DE OCAMPO</option>
                                                        <option value="VAG13041197">EDCEL BUENDIA</option>
                                                        <option value="VAG18091182">EDELIZA S. CORNEJO</option>
                                                        <option value="VAG18091136">EDEN G. RENEGADO</option>
                                                        <option value="VAG21122998">EDISON D. MEDIANE</option>
                                                        <option value="VAG11010611">EDITHA C. MAAMO</option>
                                                        <option value="VAG21123118">Editha Cortez Villanueva</option>
                                                        <option value="VAG17032927">EDMON DELA PAZ</option>
                                                        <option value="VAG11010614">EDMOND SENIER MANANSALA</option>
                                                        <option value="VAG17060232">EDMUND FLORES</option>
                                                        <option value="VAG02010320">EDNA VILLANUEVA TUMALA</option>
                                                        <option value="VAG21123049">EDUARDO M. EDANG</option>
                                                        <option value="VAG21123225">EDUARDO N. MARGALLO</option>
                                                        <option value="VAG17082969">EDUARDO VELARDE</option>
                                                        <option value="VAG12080185">EDWIN VICTORIANO R. SANDICO</option>
                                                        <option value="VAG15020687">ELAINE ABANDO</option>
                                                        <option value="VAG14102292">ELEANOR A. LOPEZ</option>
                                                        <option value="VAG21123229">Elenita A. Dizon</option>
                                                        <option value="VAG21123145">ELEONOR L. MANALO</option>
                                                        <option value="VAG15020605">ELIZABETH ANGELES</option>
                                                        <option value="VAG17032983">ELIZABETH ANNE SUAREZ</option>
                                                        <option value="VAG12013199">ELIZABETH B. ALIMURUNG</option>
                                                        <option value="VAG13031139">ELIZABETH BESANDE ALIMURUNG</option>
                                                        <option value="VAG19082332">ELIZABETH E. ABREGANA</option>
                                                        <option value="VAG14091759">ELIZABETH E. VICENTE</option>
                                                        <option value="VAG11121553">ELIZABETH R. TOLENTINO</option>
                                                        <option value="VAG15100612">ELLAINE SHYRELL V. MISLANG</option>
                                                        <option value="VAG11020359">ELLEN BILOG</option>
                                                        <option value="VAG15020628">ELLEN GARCIA</option>
                                                        <option value="VAG19072246">ELLEN O. DELOS REYES</option>
                                                        <option value="VAG15033096">ELMA V. GODINEZ</option>
                                                        <option value="VAG21123211">ELOISA P. MARFA</option>
                                                        <option value="VAG21123236">ELSBETH COLEENE R. SIBUCAO</option>
                                                        <option value="VAG12031601">ELSIE A. MENDOZA</option>
                                                        <option value="VAG11092094">ELVIN O. MENDEZ</option>
                                                        <option value="VAG18092869">ELVIRA M. SOTASO</option>
                                                        <option value="VAG17052909">EMERITA EMPAYNADO</option>
                                                        <option value="VAG14111222">EMILLIE G. SYKI</option>
                                                        <option value="VAG20011490">EMILY BLANQUERO MESIAS-MONARES</option>
                                                        <option value="VAG15022470">EMILY J. DINO</option>
                                                        <option value="VAG21123117">Emilyn Suan</option>
                                                        <option value="VAG14112423">EMMA B. GUZMAN</option>
                                                        <option value="VAG02010323">EMMA BARRIENTOS VILLARAMA</option>
                                                        <option value="VAG14021140">Emma M. Jaballas</option>
                                                        <option value="VAG11010552">EMMA TABAO DA COSTA</option>
                                                        <option value="VAG21123166">EMMANUEL C. VALLEJO</option>
                                                        <option value="VAG02010379">EMMANUEL CASTILLO VALLEJO</option>
                                                        <option value="VAG13051523">EMMANUEL MENDOZA MEDALLA</option>
                                                        <option value="VAG14060989">EMMANUEL P. BERNARDO</option>
                                                        <option value="VAG02010326">EMMANUEL S. VERZOSA</option>
                                                        <option value="VAG21123120">EMMEL T. MANLAPAZ</option>
                                                        <option value="VAG02010321">ENRIQUETTA SATURNINO DELOS REYES</option>
                                                        <option value="VAG17013098">EPIFANIA ESPIRITU</option>
                                                        <option value="VAG14111217">ERIKA T. LIM</option>
                                                        <option value="VAG21123024">Erleen Joy Castaneda</option>
                                                        <option value="VAG18091119">ERLINDA B. BANAYOS</option>
                                                        <option value="VAG17022452">ERLINDA CABANLONG</option>
                                                        <option value="VAG17021016">ERLINDA CURILAN</option>
                                                        <option value="VAG17013085">ERLINDA JULIAN</option>
                                                        <option value="VAG15020620">ERMIE GUEVARRA</option>
                                                        <option value="VAG21072901">Ernelson Francis G. Paguia, R.N</option>
                                                        <option value="VAG15020665">ERNESTO REYES</option>
                                                        <option value="VAG16080594">ERROL G. PARAS</option>
                                                        <option value="VAG11100793">ERVIN ARRIOLA</option>
                                                        <option value="VAG02010306">ERVIN ROMEO ARRIOLA</option>
                                                        <option value="VAG15100989">ESLYN MAE GONZALES</option>
                                                        <option value="VAG17102442">ESPERANZA ALMIREZ</option>
                                                        <option value="VAG16080801">ESPERANZA BERNARDO</option>
                                                        <option value="VAG02010325">ESPERANZA D. BACOLOD</option>
                                                        <option value="VAG19082390">ESTELITA L. LOPEZ</option>
                                                        <option value="VAG15020609">ESTERLITA CORRO</option>
                                                        <option value="VAG02010370">ETHEL P. TIGUE</option>
                                                        <option value="VAG02010358">EVA VIOLA YEBES</option>
                                                        <option value="VAG11010575">EVANGELINE B. ANDO</option>
                                                        <option value="VAG11010581">EVANGELINE ILAGAN BUSTOS</option>
                                                        <option value="VAG17060292">EVANGELINE MACARAEG</option>
                                                        <option value="VAG17022405">EVANGELINE TUPRIO</option>
                                                        <option value="VAG15020696">EVELINDA SABANGAN</option>
                                                        <option value="VAG17012474">EVELYN AGUDON</option>
                                                        <option value="VAG18091105">EVELYN B. DIZON</option>
                                                        <option value="VAG02010383">EVELYN GRACE VILLANUEVA RIVERA</option>
                                                        <option value="VAG21123106">EVERLITA I ALBITOS</option>
                                                        <option value="VAG17080166">FAITH DEBORRAH PAGULAYAN</option>
                                                        <option value="VAG11010550">FAUSTINO C. ELAVA</option>
                                                        <option value="VAG02010367">FE RAMIREZ SY</option>
                                                        <option value="VAG11092026">FEDELO G. LARONG</option>
                                                        <option value="VAG11010689">FEDERICO PINEDA MORALES</option>
                                                        <option value="VAG15020636">FELIX PATRICK DE GUZMAN</option>
                                                        <option value="VAG17012452">FELIX YLAGAN</option>
                                                        <option value="VAG11032518">FELOMIDEZ T. SUMALDE</option>
                                                        <option value="VAG17022436">FELY LUZ TO</option>
                                                        <option value="VAG11120528">FERNANDO FAJARDO CUETO</option>
                                                        <option value="VAG21123151">FLARIDEN M. DELA TORRE</option>
                                                        <option value="VAG15020618">FLERIZA DE GUZMAN</option>
                                                        <option value="VAG18092851">FLORABEL G. FLORALDE</option>
                                                        <option value="VAG19093046">FLORANTE L. AGAPITO</option>
                                                        <option value="VAG11051803">FLORANTE MATEO</option>
                                                        <option value="VAG11010680">FLORENDA VALDEZ MORALES</option>
                                                        <option value="VAG21123195">FRANCIA B. PAHIT</option>
                                                        <option value="VAG15100693">FRANCIS CEAZAR V. MORALES</option>
                                                        <option value="VAG15022787">FRANCIS FERDINAND E. BALGAN</option>
                                                        <option value="VAG11021846">FRANCISCO D. HIBANADA JR</option>
                                                        <option value="VAG17032939">FREMAR RABO</option>
                                                        <option value="VAG11010558">FROILAN D. CASTANEDA</option>
                                                        <option value="VAG02010303">FROILAN TAMBOT JIMENEZ</option>
                                                        <option value="VAG17022482">GAY AVENTURADO</option>
                                                        <option value="VAG21123207">GECELY D. DINO</option>
                                                        <option value="VAG16080564">GEMMA UY COBRADOR</option>
                                                        <option value="VAG02010390">GENETTE ARCELLA BAYLON</option>
                                                        <option value="VAG14111278">GENEVERE N. SY </option>
                                                        <option value="VAG11071562">GEORGE JUANO RAMIREZ</option>
                                                        <option value="VAG14102287">GERALDINE C. AGUINALDO</option>
                                                        <option value="VAG11010522">GERALDYN G. LAPORE</option>
                                                        <option value="VAG11050527">GERARDO E. BALO</option>
                                                        <option value="VAG14111233">GERMELITO B. CALLAO</option>
                                                        <option value="VAG15111292">Geronimo B. Manansala II</option>
                                                        <option value="VAG17060284">GERONIMO MACARAEG</option>
                                                        <option value="VAG15042179">GERONIMO T. MACARAEG</option>
                                                        <option value="VAG16053043">GESILA SERAFINA ABANES</option>
                                                        <option value="VAG11020376">GIBRALTAR INSURANCE AGENCY</option>
                                                        <option value="VAG15020614">GILDA LOPEZ</option>
                                                        <option value="VAG15020626">GINA GENIO</option>
                                                        <option value="VAG21123152">GLADELINE Y. CRUZ</option>
                                                        <option value="VAG15100679">GLADYS B. ALEJO</option>
                                                        <option value="VAG11072037">GLADYS CREAL DUMANDAN</option>
                                                        <option value="VAG15100633">GLADYS KAYE M. DIMAL</option>
                                                        <option value="VAG17020294">GRACE A. JAUCIAN</option>
                                                        <option value="VAG02010374">GRACE MASCARENAS OJEDA</option>
                                                        <option value="VAG11020340">GREGORIO MANLANGIT</option>
                                                        <option value="VAG15060981">GUIA S. SALVADOR</option>
                                                        <option value="VAG11120505">HAROLD BINIEGLA DIZON</option>
                                                        <option value="VAG02010399">HAZEL SALVADOR VALDERAMA</option>
                                                        <option value="VAG21123020">HAZEL R. ELIZONDO</option>
                                                        <option value="VAG14060987">HELEN SADANG</option>
                                                        <option value="VAG19062560">HELYN L. NICODEMUS</option>
                                                        <option value="VAG17022427">HERMINIA MEDINA</option>
                                                        <option value="VAG11020398">HERMINIA PINEDA</option>
                                                        <option value="VAG15020625">HERNAN CASTRO</option>
                                                        <option value="VAG11092091">HERNAN MISLANG OLIVEROS</option>
                                                        <option value="VAG19101744">HINDENBURG L. BATILO</option>
                                                        <option value="VAG18053048">HOAGY MARTIN P. ARRIOLA</option>
                                                        <option value="VAG21123202">HONELY R. GALAPIA</option>
                                                        <option value="VAG18091116">IAN CARLOS P. GO</option>
                                                        <option value="VAG17020305">IAN RAY O. DELAVIN</option>
                                                        <option value="VAG19082301">IMELDA B. BULAN</option>
                                                        <option value="VAG02010398">IMELDA BERSABE REA</option>
                                                        <option value="VAG11010583">IMELDA GEORGIA G. HOLGANZA</option>
                                                        <option value="VAG15080566">IMELDA ILAGAN DE GUZMAN</option>
                                                        <option value="VAG02010388">IMELDA J ALONSABE</option>
                                                        <option value="VAG11010579">IMELDA Y. LU</option>
                                                        <option value="VAG02010314">INGRID Z YUMANG</option>
                                                        <option value="VAG12042373">IRENE C. LEE</option>
                                                        <option value="VAG17082988">IRENE DIZON</option>
                                                        <option value="VAG02010359">IRENEROSA CHAVEZ HAGAD</option>
                                                        <option value="VAG19053177">IRISH JANE T. GUTIERREZ</option>
                                                        <option value="VAG11030844">ISABELITA N MATIENZO</option>
                                                        <option value="VAG17052912">ISAGANI COPIACO</option>
                                                        <option value="VAG19062533">IVY GRACE A. ASUTEN</option>
                                                        <option value="VAG21123181">IVY SHERYL I. LARISMA</option>
                                                        <option value="VAG16080874">JACHELLE ANN GAYOLA</option>
                                                        <option value="VAG17013068">JACINTA GERMAR</option>
                                                        <option value="VAG21123158">JAIDEE M. PALIZA</option>
                                                        <option value="VAG17111088">JAMES RUSSEL MARANTAL</option>
                                                        <option value="VAG11010507">JAN PHILIP BLANCADA ANDRES</option>
                                                        <option value="VAG02010342">JANELYN DELA CRUZ BRONDIAL</option>
                                                        <option value="VAG18092867">JANICE J. ASIS</option>
                                                        <option value="VAG02010331">JAQUELINE P. GUANIO</option>
                                                        <option value="VAG17022429">JASHMINE BAQUIANO</option>
                                                        <option value="VAG17022426">JASON JUNIO</option>
                                                        <option value="VAG21080202">Jason S. Caranzo</option>
                                                        <option value="VAG11020390">JAY CAESAR ABAD</option>
                                                        <option value="VAG17033001">JAY R D. SIMON</option>
                                                        <option value="VAG16053015">JAYELLE DE LEON GALINATO</option>
                                                        <option value="VAG17052582">JAYPEE JABAR C. GURO</option>
                                                        <option value="VAG02010361">JAYSON LACOSTE DUNCAB</option>
                                                        <option value="VAG11092096">JAYSON RICOPERTO TOLENTINO</option>
                                                        <option value="VAG12120726">JEAMSY F. LEAGSPI</option>
                                                        <option value="VAG02010389">JEANETTE Z VILLASIS</option>
                                                        <option value="VAG11010560">JEANNE M. MAGLAQUE</option>
                                                        <option value="VAG15042181">JEANNE T. JUSAYAN</option>
                                                        <option value="VAG19062162">JEANNIE L. SANTOS </option>
                                                        <option value="VAG16011973">JEFFREY RANGEL ABULENCIA</option>
                                                        <option value="VAG11010562">JENALYN S. BERNALDEZ</option>
                                                        <option value="VAG17022448">JENIFER BAQUIRAN</option>
                                                        <option value="VAG17052947">JENNIFER B. FANGKI</option>
                                                        <option value="VAG17020280">JENNIFER G. LLANA</option>
                                                        <option value="VAG17011352">JENNIFER G. LLANA</option>
                                                        <option value="VAG17013081">JENNIFER JIRO</option>
                                                        <option value="VAG11010587">JENNIFER LACEDA EDIOS</option>
                                                        <option value="VAG21123126">Jennifer M. So</option>
                                                        <option value="VAG18091386">JENNY C. GOMEZ</option>
                                                        <option value="VAG16091496">JENNY F. CABACUNGAN</option>
                                                        <option value="VAG12012032">JENUINE TIONGSON RICAFORT</option>
                                                        <option value="VAG18091162">JEPTE D. ANUNUEVO</option>
                                                        <option value="VAG13111249">JERALDYN A. PABULOS</option>
                                                        <option value="VAG11010662">JEREMY ANN LIM WINPECO</option>
                                                        <option value="VAG15042136">JERLYN C. BONI</option>
                                                        <option value="VAG14011694">Jerson P. Oledan</option>
                                                        <option value="VAG21123099">Jeson Juanico</option>
                                                        <option value="VAG17082942">JESS EMMANUEL GARRIDO</option>
                                                        <option value="VAG16053032">JESSE BONGABONG GAHUMAN</option>
                                                        <option value="VAG11010540">JESSICA DC. BANAG</option>
                                                        <option value="VAG21123110">Jessica Marie B. Albalate</option>
                                                        <option value="VAG11072099">JESSIE BERNARDO CHUA</option>
                                                        <option value="VAG15100642">JESUS C. HERNANDEZ</option>
                                                        <option value="VAG15020686">JO-ANNE R. MAGDAHERIN</option>
                                                        <option value="VAG21123155">JOANA PAULA C. PAPAS</option>
                                                        <option value="VAG02010351">JOANNA SIA NAPOLES</option>
                                                        <option value="VAG21123095">JOANNE A. CANETA</option>
                                                        <option value="VAG21123162">JOCELYN A. FORTE</option>
                                                        <option value="VAG11010537">JOCELYN C. CACCAM</option>
                                                        <option value="VAG02010346">JOCELYN DELA CRUZ ALAWI</option>
                                                        <option value="VAG15020623">JOCELYN GALVAN</option>
                                                        <option value="VAG17022463">JOCELYN PAELDON</option>
                                                        <option value="VAG21123205">JOEANNE MONTEMAYOR</option>
                                                        <option value="VAG14021171">JOEL C. TORREJA</option>
                                                        <option value="VAG12031613">JOEL Z. DE GUZMAN</option>
                                                        <option value="VAG02010311">JOEL ZAFRA DE GUZMAN</option>
                                                        <option value="VAG14060938">JOEY L. RIVAMONTE</option>
                                                        <option value="VAG16080540">JOGE NAOE</option>
                                                        <option value="VAG14060916">JOGI S. RIVAMONTE</option>
                                                        <option value="VAG12051540">JOHANNES S. KALUGDAN</option>
                                                        <option value="VAG21123224">JOHN CARIO DAVID</option>
                                                        <option value="VAG21123030">JOHN HENRY "PYXIE" LI</option>
                                                        <option value="VAG21123141">JOHN MICHAEL G. BALABA</option>
                                                        <option value="VAG21123001">JOHN RAINHEART M. LOPEZ</option>
                                                        <option value="VAG21030196">JONARD V. BORLAZA</option>
                                                        <option value="VAG21123092">JONATHAN B. RUBRICO</option>
                                                        <option value="VAG02010337">JONATHAN SAMSON DAYOLA</option>
                                                        <option value="VAG15111217">Jonathan V. Pi�ol</option>
                                                        <option value="VAG02010330">JOSE CABILLO SISON JR.</option>
                                                        <option value="VAG17050367">JOSE F. ORETA JR.</option>
                                                        <option value="VAG11021868">JOSE JEFF URSAL DAMAYO</option>
                                                        <option value="VAG16080837">JOSE LUIS DAVA</option>
                                                        <option value="VAG17080396">JOSE ORETA JR.</option>
                                                        <option value="VAG19082350">JOSE REYNALDO C. BALINAS</option>
                                                        <option value="VAG16080979">JOSEFA V. DE LEMOS</option>
                                                        <option value="VAG17022401">JOSEFINA REGALIZA</option>
                                                        <option value="VAG15020643">JOSEFINA VIDUYA</option>
                                                        <option value="VAG12032635">JOSEFINA VITERBO SORIANO</option>
                                                        <option value="VAG02010363">JOSEFINO MARIANO MENDOZA</option>
                                                        <option value="VAG18092804">JOSELITO L. DOLATRE</option>
                                                        <option value="VAG15020654">JOSELITO SENEGOSIO</option>
                                                        <option value="VAG11101130">JOSEPH MARI FLORES</option>
                                                        <option value="VAG14060962">JOSEPH S. YUCOR</option>
                                                        <option value="VAG16053095">JOSEPH SUAREZ MONTES</option>
                                                        <option value="VAG02010380">JOSEPH SUAREZ MONTES</option>
                                                        <option value="VAG17021021">JOSEPHINE CARRANZA</option>
                                                        <option value="VAG11010606">JOSEPHINE CO VILLACRUSIS</option>
                                                        <option value="VAG12021796">JOSEPHINE SANTOS</option>
                                                        <option value="VAG12120785">JOSIAH A. ANDRES</option>
                                                        <option value="VAG15030306">JOVITA J. GESTA</option>
                                                        <option value="VAG15060916">JOY ANNE R. MANGALINDAN</option>
                                                        <option value="VAG21082505">Joyce Rosette Cosme</option>
                                                        <option value="VAG21080201">Juan Carlos V. Sebastian</option>
                                                        <option value="VAG17082960">JUANITA GURO</option>
                                                        <option value="VAG14082811">Julie Ann L. Milano</option>
                                                        <option value="VAG17070408">JULIE ANNE MAE I. JOSE</option>
                                                        <option value="VAG14060968">JULIET G. CO</option>
                                                        <option value="VAG17082970">JULIET ARANETA</option>
                                                        <option value="VAG11020399">JULIET BULAON</option>
                                                        <option value="VAG12012079">JULIETA MAREGMEN LULU</option>
                                                        <option value="VAG11010656">JULIUS V. DRES</option>
                                                        <option value="VAG16053088">JUSTINE MARIE JADRAQUE MONTES</option>
                                                        <option value="VAG16010411">JYMARRYEL O. NGITNGIT</option>
                                                        <option value="VAG20110527">KAREN ANNE DUMIA</option>
                                                        <option value="VAG11010577">KARL EMMANUELLE T. TAN</option>
                                                        <option value="VAG17082950">KARMINA RIBULTAN</option>
                                                        <option value="VAG14111235">KATRINA ANNE G. RACPAN</option>
                                                        <option value="VAG15020671">KAYE ALBANA</option>
                                                        <option value="VAG21123238">KEVIN BARRAQUIAS DELOS SANTOS</option>
                                                        <option value="VAG12012069">KHRISTINE KAREN L. SARMIENTO</option>
                                                        <option value="VAG02010371">KIM KIAT ALBEZA PASCUAL</option>
                                                        <option value="VAG21123157">KIMBERLI M. DAVID</option>
                                                        <option value="VAG14082707">KRISEL M. GARIN</option>
                                                        <option value="VAG11082405">KRISTEL ANDREA TANTOCO PASCO</option>
                                                        <option value="VAG11081519">KRISTINA BERNADETTE AGUSTIN MANABAT</option>
                                                        <option value="VAG20121049">kuh carbonilla</option>
                                                        <option value="VAG18091199">LAHNI ROSS R. ROSCO</option>
                                                        <option value="VAG18071960">LAHNI ROSS ROSCO</option>
                                                        <option value="VAG17012481">LAMBERTO RAMOS JR.</option>
                                                        <option value="VAG15020647">LANI ANTIOJO</option>
                                                        <option value="VAG21123182">LARRY E. MAMARIL</option>
                                                        <option value="VAG11051810">LARRY PADILLA</option>
                                                        <option value="VAG15042109">LAURIANO L. BIHAG</option>
                                                        <option value="VAG11092055">LEDELYN GALLEGO ONDAJON</option>
                                                        <option value="VAG14060941">LENNIE G. FERNANDEZ</option>
                                                        <option value="VAG02010364">LENUEL C. QUERIMIT</option>
                                                        <option value="VAG16080941">LEONARD MICHAEL MARK RANDRUP</option>
                                                        <option value="VAG15111238">Leonardo N. Pidlaoan</option>
                                                        <option value="VAG16080508">LEONILO SANDINO M. DOLORICON</option>
                                                        <option value="VAG17080107">LEONOR AQUINO</option>
                                                        <option value="VAG17021452">LEONORA M. QUISAO</option>
                                                        <option value="VAG10112524">LEOPOLDO MAGNAYE</option>
                                                        <option value="VAG15020602">LETICIA ABENOJAR</option>
                                                        <option value="VAG17022472">LETICIA DACANAY</option>
                                                        <option value="VAG11020313">LIBERTAD F. DELA CHICA</option>
                                                        <option value="VAG11092047">LILIA RAQUIZA FAJANILBO</option>
                                                        <option value="VAG11010693">LILIAN DE JESUS PORTUS</option>
                                                        <option value="VAG15022422">LILIAN L. YAO</option>
                                                        <option value="VAG19082393">LILIBETH G. ACABADO</option>
                                                        <option value="VAG15020645">LILMA PERADILLA</option>
                                                        <option value="VAG15020637">LILMA VENTURA</option>
                                                        <option value="VAG20051802">LINDJIE V. GARCIA</option>
                                                        <option value="VAG21123071">LOLITA A. VILLANUEVA</option>
                                                        <option value="VAG16080858">LOLITA ALIERMO</option>
                                                        <option value="VAG02010382">LORENZA BERNABE DE GUZMAN</option>
                                                        <option value="VAG17021090">LORETA LABADO</option>
                                                        <option value="VAG15020608">LORNA ARAGON</option>
                                                        <option value="VAG14111284">LORRAINE T. YU</option>
                                                        <option value="VAG11071535">LOURDES LOPEZ SERRANO</option>
                                                        <option value="VAG02010336">LOURDES PASCUAL GALANG</option>
                                                        <option value="VAG21123206">LOURDJEAN A. SOLARTE</option>
                                                        <option value="VAG12102253">LOUVIC C. GATCHALIAN</option>
                                                        <option value="VAG11012183">LOWIE Z. LAGADO</option>
                                                        <option value="VAG15020689">LUALHATI GAMO</option>
                                                        <option value="VAG19062545">LUCILLE M. GATDULA</option>
                                                        <option value="VAG18100455">LUCILYN TABIOS</option>
                                                        <option value="VAG19092667">LUISITO T. VILLAR</option>
                                                        <option value="VAG15111281">Luningning M. Lopez</option>
                                                        <option value="VAG15033015">LUZ D. ULEP</option>
                                                        <option value="VAG17060228">LUZ MYRIAM CARSI-CRUZ</option>
                                                        <option value="VAG02010362">LUZ VARGAS DEPASUPIL</option>
                                                        <option value="VAG17013008">LYANJANE GERMAR</option>
                                                        <option value="VAG02010356">LYDIA MARFIL SUMICION</option>
                                                        <option value="VAG21123093">LYRA B. TORIO</option>
                                                        <option value="VAG15100662">LYSANDER P. RAGODON</option>
                                                        <option value="VAG15071430">LYSANDER PANTE RAGODON</option>
                                                        <option value="VAG21123220">MA JESSICA B. BALDO</option>
                                                        <option value="VAG02010391">MA. ALMA YECLA DARIA</option>
                                                        <option value="VAG02010341">MA. AMABELLA GABON NABABLIT</option>
                                                        <option value="VAG11120561">MA. ANGELICA S. ESCONDO</option>
                                                        <option value="VAG17013087">MA. ANTONIETTA PRADO</option>
                                                        <option value="VAG16080534">MA. BELEN ABELLA</option>
                                                        <option value="VAG17060253">MA. BENEDICTA JOSEFINA DY-LIACCO</option>
                                                        <option value="VAG18091365">MA. CAROLINA M. REYES</option>
                                                        <option value="VAG18111375">MA. CHRISTINA M. CORPUZ</option>
                                                        <option value="VAG11010519">MA. CRISTINA C. SANCHEZ</option>
                                                        <option value="VAG21082503">MA. CRISTINA M. PALILEO</option>
                                                        <option value="VAG11010563">MA. GENNA P. GUEVARRA</option>
                                                        <option value="VAG17060212">MA. GINA CEDE�O</option>
                                                        <option value="VAG21123128">MA. GLORIA EASTER C. SILARDE</option>
                                                        <option value="VAG19121056">MA. LIZA A. ABENOJAR</option>
                                                        <option value="VAG16080907">MA. LOURDES M. OLAYA</option>
                                                        <option value="VAG12102210">MA. LUISA R. VISTRO</option>
                                                        <option value="VAG17070456">MA. LYN PILADA</option>
                                                        <option value="VAG02010324">MA. MARISSA TOROBA FERNANDO</option>
                                                        <option value="VAG17052967">MA. REDELIA AUXILIAN</option>
                                                        <option value="VAG11010670">MA. ROSA MENDOZA ORCULLO</option>
                                                        <option value="VAG15111259">Ma. Soledad L. Sulquiano</option>
                                                        <option value="VAG15020679">MA. SOPHIA LOREN VALENZUELA</option>
                                                        <option value="VAG11061778">MA. TERESA CONSUELO BACALA</option>
                                                        <option value="VAG21123138">MA. TERESA D. CAPUA</option>
                                                        <option value="VAG21123222">MA. TERESA GARCIA DE LEON</option>
                                                        <option value="VAG18091180">MA. TERESA S. DELA PAZ</option>
                                                        <option value="VAG17022409">MA. TERESA SOLOMON</option>
                                                        <option value="VAG17052955">MA. TERESITA MATEO</option>
                                                        <option value="VAG17022444">MA. THERESA E. REYES</option>
                                                        <option value="VAG11010664">MA. THERESA GUITCHE CENIZA</option>
                                                        <option value="VAG02010352">MA.CONSUELO ABEAR PANALIGAN</option>
                                                        <option value="VAG02010365">MA.CORAZON AGUADA CRUZ</option>
                                                        <option value="VAG02010329">MA.LOURDES LADO LAO</option>
                                                        <option value="VAG17080193">MAE ANN CAMILLE GARBIN</option>
                                                        <option value="VAG02010396">MAMERTO PRIGO TENORIO</option>
                                                        <option value="VAG21123164">MANILENE CLAIRE A. MALIM</option>
                                                        <option value="VAG02010310">MANUEL CHAVEZ ADRIANO</option>
                                                        <option value="VAG11010594">MANUEL MIGUEL C. COLOMA</option>
                                                        <option value="VAG11051834">MARCELINO PAYABYAB</option>
                                                        <option value="VAG02010350">MARCELINO SANTIAGO DELA CRUZ</option>
                                                        <option value="VAG02010348">MARIA CARMEN ZEPEDA FERRER</option>
                                                        <option value="VAG19053175">MARIA CECILIA M. SAPNU</option>
                                                        <option value="VAG19062578">MARIA CECILIA M. SAPNU</option>
                                                        <option value="VAG11061736">MARIA CRISTINA CONSUELO BONTO</option>
                                                        <option value="VAG11071521">MARIA DELIA RANIS ROSARIO</option>
                                                        <option value="VAG21123156">MARIA DULCE JENNIFER T. VARON</option>
                                                        <option value="VAG21123221">MARIA ELFIE L JUNIO</option>
                                                        <option value="VAG11010556">MARIA ESPERANZA G. RAMOS</option>
                                                        <option value="VAG21123090">MARIA ESTELA G. DE VILLA</option>
                                                        <option value="VAG16080530">MARIA FE Q. LALAP</option>
                                                        <option value="VAG13030169">MARIA FRANCESSCA C. ZULUETA</option>
                                                        <option value="VAG17080191">MARIA GYNETH CENTENO</option>
                                                        <option value="VAG16112502">MARIA LUCILLE E. DIAZ</option>
                                                        <option value="VAG21123174">MARIA RACHELLE, ALOB, ORTEGA</option>
                                                        <option value="VAG21123163">MARIA RIZALINA H. GASCON</option>
                                                        <option value="VAG21123186">MARIA RIZALINA H. GASCON</option>
                                                        <option value="VAG21123028">MARIA ROSALINDA REYES PANUNCIALMAN</option>
                                                        <option value="VAG21123103">Maria Stephanie Ann S. Torcella</option>
                                                        <option value="VAG21123116">Maria Stephanie Ann S. Torcella</option>
                                                        <option value="VAG20061937">MARIA TERESA SANTILLAN</option>
                                                        <option value="VAG19082323">MARIA THERESA B. MEDRANO</option>
                                                        <option value="VAG11010524">MARIA THERESA CARAG UI</option>
                                                        <option value="VAG12021748">MARIA THERESA MEDINA ECHON</option>
                                                        <option value="VAG15022458">MARIA VERONICA F. SOTELO</option>
                                                        <option value="VAG11081534">MARIAN LUZ AGUSTIN MANABAT</option>
                                                        <option value="VAG12080157">MARIBEL OBRERO MEDRANO</option>
                                                        <option value="VAG21123122">Maribel P. Isip</option>
                                                        <option value="VAG11072086">MARICAR CACCAM BATOON</option>
                                                        <option value="VAG15020653">MARIE ANN COTOCO</option>
                                                        <option value="VAG21123100">Marie Fe T. Maristela</option>
                                                        <option value="VAG19100760">MARIE LOU G. AMURAO</option>
                                                        <option value="VAG11010527">MARIE PAULIT E. REALIZA</option>
                                                        <option value="VAG11051883">MARIE TANEGA</option>
                                                        <option value="VAG11060201">MARIETA PANGILINAN JAMILANO</option>
                                                        <option value="VAG15100689">MARIFE I. YABUT</option>
                                                        <option value="VAG15071467">MARIFE ILANO YABUT</option>
                                                        <option value="VAG17012404">MARILEN T. LAGNITON</option>
                                                        <option value="VAG18091361">MARILOU E. LABAO</option>
                                                        <option value="VAG15042104">MARILOU L. IBEA</option>
                                                        <option value="VAG17052980">MARILOU SAMCHAO</option>
                                                        <option value="VAG11081551">MARILYN BALDOVIA PAYRA</option>
                                                        <option value="VAG11010529">MARILYN L. PABIONA</option>
                                                        <option value="VAG02010392">MARILYN T. PALOGAN</option>
                                                        <option value="VAG11010631">MARINA DIOLA SABINO</option>
                                                        <option value="VAG21123124">Marino C. Reyes</option>
                                                        <option value="VAG11010661">MARINO CUEVAS REYES</option>
                                                        <option value="VAG11051889">MARISSA CRUZ</option>
                                                        <option value="VAG02010387">MARISSA EJERCITO BORINES</option>
                                                        <option value="VAG17022471">MARISSA SATORRE</option>
                                                        <option value="VAG02010318">MARIVIC J PASCUA</option>
                                                        <option value="VAG19062535">MARIVIC PREMACIO LAZARO</option>
                                                        <option value="VAG21082506">Marjorie Aduan</option>
                                                        <option value="VAG18100473">MARK ANDRIEL BERNARDO</option>
                                                        <option value="VAG21123191">MARK ANGELO B. BACOLOR</option>
                                                        <option value="VAG21123228">MARK ANTHONY C. PANA</option>
                                                        <option value="VAG21123169">MARK ANTHONY D. SANTOS</option>
                                                        <option value="VAG16080547">MARK FIDEL ROQUE</option>
                                                        <option value="VAG17060223">MARLON SALAZAR</option>
                                                        <option value="VAG15020673">MARLYN DE RAMOS</option>
                                                        <option value="VAG11010641">MARUJITA S. PALABRICA</option>
                                                        <option value="VAG15020663">MARY ALICE RODRIGUEZ</option>
                                                        <option value="VAG11081748">MARY ANN BUENAFLOR TIBAYAN</option>
                                                        <option value="VAG02010366">MARY ANN FRANCISCO CADILO</option>
                                                        <option value="VAG11051884">MARY ANN P. ABAYA</option>
                                                        <option value="VAG21080203">Mary Anne Guerindola</option>
                                                        <option value="VAG11010602">MARY CATHERINE VALDEZ MORALES</option>
                                                        <option value="VAG15033008">MARY FATIMA B. LIANKO</option>
                                                        <option value="VAG18100421">MARY GRACE BERNARDO</option>
                                                        <option value="VAG11010555">MARY GRACE P. CHENG</option>
                                                        <option value="VAG21123127">Mary Grace T. Gonzales</option>
                                                        <option value="VAG12102237">MARY ROSE I. ARRIOLA</option>
                                                        <option value="VAG21123159">MARYJANE S. MENDIOLA</option>
                                                        <option value="VAG21123203">Matt Dillon O. Kho </option>
                                                        <option value="VAG19072250">MATTHEW JEHU CHENG SY</option>
                                                        <option value="VAG15020672">MATTHEW TAN</option>
                                                        <option value="VAG16010499">MAUREEN B. RILLION</option>
                                                        <option value="VAG15020611">MAXIMO DE LOS SANTOS</option>
                                                        <option value="VAG17082946">MAY OLEDAN</option>
                                                        <option value="VAG19082326">MAYBELLINE A. BANDERADO</option>
                                                        <option value="VAG13051591">MAYLIN ALBERTO STA. ANA</option>
                                                        <option value="VAG21123204">MEDELYN ESTRELLA</option>
                                                        <option value="VAG02010375">MEDINA A. BARBACENA-VELBIS</option>
                                                        <option value="VAG15100641">MELANDRO Q. BORJA</option>
                                                        <option value="VAG15020621">MELENCIO SANTOS</option>
                                                        <option value="VAG21123146">MELISSA C. PIMENTEL</option>
                                                        <option value="VAG14111205">MELROSE A. CO</option>
                                                        <option value="VAG17011304">MERCEDES R. SANTOS</option>
                                                        <option value="VAG16080549">MERCEDITA A. NISPEROS</option>
                                                        <option value="VAG21123114">MERIAM P. PAROL</option>
                                                        <option value="VAG15100653">MERILYN S. TORRE</option>
                                                        <option value="VAG21123197">MERINOR MANGADAP</option>
                                                        <option value="VAG14060979">MERLE ANN A. FABELLA</option>
                                                        <option value="VAG21123183">MICHAEL ANGEL T. PANLILIO</option>
                                                        <option value="VAG21123173">Michael Angelo Telan Panlilio</option>
                                                        <option value="VAG21123023">Michael Espanol Ching</option>
                                                        <option value="VAG02010373">MICHAEL VIRAY ACIERTO</option>
                                                        <option value="VAG11020387">MICHAELANGELO R. MERCADO</option>
                                                        <option value="VAG11010526">MICHEAS D. DUMLAO</option>
                                                        <option value="VAG02010301">MICHELANGELO RAMOS MERCADO</option>
                                                        <option value="VAG18091125">MIGUELITO KIEL T. CANDIDO</option>
                                                        <option value="VAG17022422">MILAGROS O. SPALDING</option>
                                                        <option value="VAG16021215">MINERVA CAROL ALAG</option>
                                                        <option value="VAG16021627">MINERVA CAROL ALAG</option>
                                                        <option value="VAG21123115">MINROSE DE SALET LAPITAN</option>
                                                        <option value="VAG11010567">MIRIAM E. DEL MUNDO</option>
                                                        <option value="VAG15020688">MONINA DATILES</option>
                                                        <option value="VAG17060203">MORETO VALIAO JR.</option>
                                                        <option value="VAG18091104">MYLENE V. GUEVARA</option>
                                                        <option value="VAG13071003">MYRA G. CATAPANG</option>
                                                        <option value="VAG21123237">MYRA S. NARES</option>
                                                        <option value="VAG11060987">MYRNA C. CASTRO</option>
                                                        <option value="VAG17052924">MYRNA COPIACO</option>
                                                        <option value="VAG02010316">MYRNA M. PUNONGBAYAN</option>
                                                        <option value="VAG21123081">MYRNA S. PARAS</option>
                                                        <option value="VAG21123119">Myrna San Pedro Paras</option>
                                                        <option value="VAG02010353">NA. JOSEPHINE TOLENTINO GELLA</option>
                                                        <option value="VAG16080898">NARISSA T. REGINALDO</option>
                                                        <option value="VAG19072286">NATALIE JANE L. YEO</option>
                                                        <option value="VAG11072049">NEIL BENEDICT REYES AMBROSIO</option>
                                                        <option value="VAG12013032">NEIL VINCENT C. SANDOVAL</option>
                                                        <option value="VAG14011637">Nelia A. Raga</option>
                                                        <option value="VAG02010339">NELIA GUERRERO ROMERO</option>
                                                        <option value="VAG14060912">NEMIA C. FLORO</option>
                                                        <option value="VAG16053030">NENITA J. ALCASID</option>
                                                        <option value="VAG19082385">NILDA C. AVENTURA</option>
                                                        <option value="VAG17012456">NI�O MENOR</option>
                                                        <option value="VAG15100931">NOEL FLORES</option>
                                                        <option value="VAG11010598">NOIME MORALES DE MESA</option>
                                                        <option value="VAG02010334">NORALYN IDAGO DELA CRUZ</option>
                                                        <option value="VAG17013039">NORBERTO EDWIN GUZMAN JR.</option>
                                                        <option value="VAG17022443">NORMAN BRYAN WAGAN</option>
                                                        <option value="VAG17012469">NORMITA LOBARBIO</option>
                                                        <option value="VAG16111424">OFELIA AFABLE AZORES</option>
                                                        <option value="VAG15020698">OFELIA PILAR</option>
                                                        <option value="VAG15033066">OLIVER WENDELL T. YAP</option>
                                                        <option value="VAG15033066">OLIVER WENDELL T. YAP</option>
                                                        <option value="VAG12021046">OLIVIA CAPULONG</option>
                                                        <option value="VAG15020650">PANCHO SALGADO</option>
                                                        <option value="VAG21123129">PAUL MILLER A. LAGUNA</option>
                                                        <option value="VAG11021816">PAZ T. BAY</option>
                                                        <option value="VAG21123148">PEACHY D. TACULOD</option>
                                                        <option value="VAG20061566">PEACHY TACULOD</option>
                                                        <option value="VAG11010582">PEDRO FAUSTINO F. REYES</option>
                                                        <option value="VAG21123027">PERLITA TIU</option>
                                                        <option value="VAG15020631">PETRONILLO SAN GABRIEL</option>
                                                        <option value="VAG21122996">PIA PAULINE E. SIANO</option>
                                                        <option value="VAG21123212">PILAR GONZALES</option>
                                                        <option value="VAG12042321">PINKY J. PADAYAW</option>
                                                        <option value="VAG15020617">POMPEYO SAULO</option>
                                                        <option value="VAG15020667">PRISCILLA DIZON</option>
                                                        <option value="VAG17060297">PRISCILLA GUMIRAN</option>
                                                        <option value="VAG14021122">Proserfina M. Lajom</option>
                                                        <option value="VAG21123188">PRUDENT DOMINIC A. GUERRERO</option>
                                                        <option value="VAG02010354">QUIRINO LUMBA GALANG</option>
                                                        <option value="VAG17022456">RAFAELITA MAE ESTELLA</option>
                                                        <option value="VAG21123131">RAMCES B. NARAG</option>
                                                        <option value="VAG15020674">RAMON BERNASON</option>
                                                        <option value="VAG11092086">RAMON ESPIRITU CASAS</option>
                                                        <option value="VAG21082501">RAMON M. SARZUELO</option>
                                                        <option value="VAG02010368">RAMON SAN AGUSTIN RIVERA</option>
                                                        <option value="VAG17082954">RANDY AMPARO</option>
                                                        <option value="VAG17082948">RANDY AMPARO</option>
                                                        <option value="VAG17080136">RANDY JUDE BORDEOS</option>
                                                        <option value="VAG21123161">RAQUEL A. MATA</option>
                                                        <option value="VAG02010302">RAQUEL GONZALES ALBANA</option>
                                                        <option value="VAG11010574">RAQUEL M. JALANDO-ON</option>
                                                        <option value="VAG02010335">RAYMOND PAUL SIMON BABASA</option>
                                                        <option value="VAG11071557">RAYMUNDO PENAFLOR LIWANAG</option>
                                                        <option value="VAG15020661">REBECCA VALDEZ</option>
                                                        <option value="VAG13120291">REGINA JUDITH C. BARRENECHEA</option>
                                                        <option value="VAG16080526">REGINALDO, NARISSA</option>
                                                        <option value="VAG21123227">Regine May Balondo Dancel</option>
                                                        <option value="VAG15020604">REMEDIOS GARZON</option>
                                                        <option value="VAG17110985">REMUS P. MANJARES</option>
                                                        <option value="VAG02010345">RENE ADEVA CRUZ</option>
                                                        <option value="VAG21123096">REY B. DE VERA</option>
                                                        <option value="VAG19070870">REY MARC F. SALVADOR</option>
                                                        <option value="VAG21123029">Reyel Cresentino D. Jimenez</option>
                                                        <option value="VAG17121893">REYNALD JOSEPH G. DALAN</option>
                                                        <option value="VAG21123160">RHODA H. ARANCO</option>
                                                        <option value="VAG11010589">RICHARD D. GONZALES</option>
                                                        <option value="VAG02010372">RICHARD G BARREDO</option>
                                                        <option value="VAG15100643">RICHARD G. MANUEL</option>
                                                        <option value="VAG15071425">RICHARD GERSTIADA MANUEL</option>
                                                        <option value="VAG21123002">Ricky Malapit</option>
                                                        <option value="VAG21123217">RICO M. MORETO</option>
                                                        <option value="VAG14111202">RILEY ANDERSEEN A. WINPECO</option>
                                                        <option value="VAG18071942">RIZA MACABALI</option>
                                                        <option value="VAG15100678">RIZA N. GISON</option>
                                                        <option value="VAG15071498">RIZA NAVARRO GISON</option>
                                                        <option value="VAG18091126">RIZA P. MACABALI</option>
                                                        <option value="VAG14112405">RIZALDY D. DE LEON</option>
                                                        <option value="VAG15111225">Rizalina B. Gonzalez</option>
                                                        <option value="VAG15020603">RIZALINA CASTILLO</option>
                                                        <option value="VAG11081503">RIZALITA TAGUILAZO ROBEL</option>
                                                        <option value="VAG17052919">ROAN B. CRUZ</option>
                                                        <option value="VAG15060960">ROBEL D. LORENZO</option>
                                                        <option value="VAG14091733">ROBERTO B. ROBLES</option>
                                                        <option value="VAG14011631">Robinson B. Montoya</option>
                                                        <option value="VAG02010385">RODNEY AURELIO BAOAYAN</option>
                                                        <option value="VAG02010386">RODOLFO V PANTIG</option>
                                                        <option value="VAG17082916">ROLAND FLORES</option>
                                                        <option value="VAG15020690">ROLANDO CASTANETAS</option>
                                                        <option value="VAG11051878">ROLANDO PAGUIO</option>
                                                        <option value="VAG02010319">ROMANA P. PEREZ</option>
                                                        <option value="VAG16010415">ROMEO A. PINPIN</option>
                                                        <option value="VAG11010513">ROMEO VILLAS CASTILLO</option>
                                                        <option value="VAG02010305">ROMULO VILLABUEVA TUMALA</option>
                                                        <option value="VAG11072062">RON MARVIN VERDON MIRANDA</option>
                                                        <option value="VAG02010315">RONALD BARICAN TRAJANO</option>
                                                        <option value="VAG15100645">RONALD R. MACALALAD</option>
                                                        <option value="VAG15071496">RONALD ROMEN MACALALAD</option>
                                                        <option value="VAG11010592">ROSALIE PASCUA RONQULLO</option>
                                                        <option value="VAG02010344">ROSALINDA CALIMLIM VERGARA</option>
                                                        <option value="VAG02010349">ROSALINDA DELOS SANTOS</option>
                                                        <option value="VAG02010395">ROSALYN ARTIAGA DE LEON</option>
                                                        <option value="VAG16080868">ROSALYN PICHAY</option>
                                                        <option value="VAG11101424">ROSALYO DE LEON</option>
                                                        <option value="VAG11010605">ROSANA MAGNAYE GARQUE</option>
                                                        <option value="VAG14011667">Rosario B. Zapa</option>
                                                        <option value="VAG21123108">ROSARIO M. BALITA</option>
                                                        <option value="VAG14081901">ROSARIO M. COMEDOY</option>
                                                        <option value="VAG21123038">ROSARIO MEDINA BALITA</option>
                                                        <option value="VAG11051875">ROSARIO PADILLA</option>
                                                        <option value="VAG02010397">ROSAURO ESPIRITU BAMBILLA</option>
                                                        <option value="VAG11092291">ROSE MARY GOCUAN TACDER</option>
                                                        <option value="VAG02010357">ROSELLE CAYABYAB TAGLE</option>
                                                        <option value="VAG18050448">ROSINNI NUEVA ECIJA PANTUA</option>
                                                        <option value="VAG14102219">ROSMIE D. NAMBATOC</option>
                                                        <option value="VAG14011643">Rosyline H. Dimaunahan</option>
                                                        <option value="VAG17080170">ROWENA BAWAGAN</option>
                                                        <option value="VAG15020630">ROWENA CAFE</option>
                                                        <option value="VAG11120540">ROWENA DIANE ENCOMIENDA BALO</option>
                                                        <option value="VAG02010369">ROWENA MARGARITA CUYCO SUAREZ</option>
                                                        <option value="VAG15020612">ROWENA MASALANG</option>
                                                        <option value="VAG11010630">RUBINA DE GUZMAN GACUTAN</option>
                                                        <option value="VAG21123144">RUBYMAE BOLOTANO JUMAO-AS</option>
                                                        <option value="VAG11071599">RUCHIEL MACAPAGAL BERIN</option>
                                                        <option value="VAG21123147">RUDY ANN S. DELA CRUZ</option>
                                                        <option value="VAG11092053">RUEL BUQUIRIN CASALHAY</option>
                                                        <option value="VAG19062543">RUFINA M. REYES</option>
                                                        <option value="VAG11081584">RYAN JAY DE DIOS VARONA</option>
                                                        <option value="VAG15022403">RYAN JEFF T. MONTES</option>
                                                        <option value="VAG16080505">RYAN PAUL R. LIMON</option>
                                                        <option value="VAG19062570">RYAN T. CA�ETA</option>
                                                        <option value="VAG21123123">Sally P. Tancio</option>
                                                        <option value="VAG02010317">SALVADOR GELITO SOLIDUM</option>
                                                        <option value="VAG21123097">SAMALINDA A. MAGALE</option>
                                                        <option value="VAG16080916">SERLITA F. CACHO</option>
                                                        <option value="VAG19072262">SHANNEN KAYE L. ALI</option>
                                                        <option value="VAG21123113">SHARON MAE T. CASINO</option>
                                                        <option value="VAG21123149">SHEIVELYN A. COMILANG</option>
                                                        <option value="VAG21123154">SHEMAMEE C. MIRASOL</option>
                                                        <option value="VAG15100626">SHEN KENNETH G. PULGA</option>
                                                        <option value="VAG11010539">SHIERLY V. SAN JOSE</option>
                                                        <option value="VAG17021038">SHIRLEY TABLICO</option>
                                                        <option value="VAG16112575">SILVIA MENDOZA MOYA</option>
                                                        <option value="VAG15020668">SLF Philippines Multi-purpose Employees Cooperative (SPEMCI) </option>
                                                        <option value="VAG17052981">SOLEDAD CRUZ</option>
                                                        <option value="VAG02010333">SONIA B. VILLANUEVA</option>
                                                        <option value="VAG02010343">SONIA BATANG ISORENA</option>
                                                        <option value="VAG21123047">SONIA M. ATON</option>
                                                        <option value="VAG21123072">SOPHIA LOREN VALENZUELA</option>
                                                        <option value="VAG14111257">STEVEN Y. TAN</option>
                                                        <option value="VAG13041104">SURESH HASHUMAL KARNANI</option>
                                                        <option value="VAG14021184">Susan S. Tudla</option>
                                                        <option value="VAG17021001">SUSAN AGUILAR</option>
                                                        <option value="VAG11092032">SUSAN DE BORJA JASARINO</option>
                                                        <option value="VAG11020303">SUSAN DELA CRUZ</option>
                                                        <option value="VAG02010309">SUSAN L LOPEZ</option>
                                                        <option value="VAG17080113">SUSAN M. MANECLANG</option>
                                                        <option value="VAG14011618">Susan Q. Halili</option>
                                                        <option value="VAG20061564">SUSAN R. MIRADOR</option>
                                                        <option value="VAG11010595">SYLVIA A. ANDINO</option>
                                                        <option value="VAG21123140">SYLVIA G. JOSEPH</option>
                                                        <option value="VAG02010322">SYLVIA RUTH APO RELLEVE</option>
                                                        <option value="VAG11010508">TARA ANN S. GONZALES</option>
                                                        <option value="VAG11020325">TERESITA CAPISEN</option>
                                                        <option value="VAG02010393">TERESITA CONSUELO SANTOS</option>
                                                        <option value="VAG02010338">TERESITA TRAVERO CHUN</option>
                                                        <option value="VAG19062537">TEYA B. MAGALING</option>
                                                        <option value="VAG11020319">TIME IS GOLD</option>
                                                        <option value="VAG21123035">TONY KING R. ZARA</option>
                                                        <option value="VAG19072256">TRISHA MAE GO QUE YEUNG</option>
                                                        <option value="VAG15022465">TRISTAN C. GUERRERO</option>
                                                        <option value="VAG16053018">TRISTAN CAFIRMA GENARO</option>
                                                        <option value="VAG11010546">TRISTAN ERIC C. CANTO</option>
                                                        <option value="VAG21123098">VAN A. DOREN</option>
                                                        <option value="VAG21123179">VAN A. DOREN</option>
                                                        <option value="VAG21123073">VAN ABIAN DOREN</option>
                                                        <option value="VAG20101336">VC- IF WEBINAR - PAULINE PECHO</option>
                                                        <option value="VAG20101360">VC- IF WEBINAR-PIA PAULINE SIANO</option>
                                                        <option value="VAG20101399">VC- IF WEBINAR-SHAIRA CRUZ</option>
                                                        <option value="VAG20101399">VC- IF WEBINAR-SHAIRA CRUZ</option>
                                                        <option value="VAG21123137">VC-DS-DANILO S. CUSTODIO JR.</option>
                                                        <option value="VAG20020508">VC-IAPPLY-SHAIRA CRUZ</option>
                                                        <option value="VAG20020553">VC-PHONEIN-SHAIRA CRUZ</option>
                                                        <option value="VAG20020522">VC-REFERRAL-SHAIRA CRUZ</option>
                                                        <option value="VAG19062571">VEENA MARIE S. ROLDAN</option>
                                                        <option value="VAG16053069">VENICIA LITERAL RANCES</option>
                                                        <option value="VAG21123178">VERNAN RALPH HEBRA</option>
                                                        <option value="VAG16053048">VERONILLA JADRAQUE MONTES</option>
                                                        <option value="VAG11012171">VICKY M. MENDOZA</option>
                                                        <option value="VAG15020669">VICTORIA FAMENTERA</option>
                                                        <option value="VAG21123230">VICTORIA I. LIM</option>
                                                        <option value="VAG17022424">VICTORIA LIGAYA</option>
                                                        <option value="VAG11010523">VICTORIANO B. AUSTERO</option>
                                                        <option value="VAG11120580">VILAMINA DOPLITO CINA</option>
                                                        <option value="VAG11010570">VILMA M. VIZCARRA</option>
                                                        <option value="VAG17020273">VIOLETA RIVERA</option>
                                                        <option value="VAG12031488">VIRGILIO M. MARANTAL</option>
                                                        <option value="VAG13051508">VIVIAN FLORES CASTRO</option>
                                                        <option value="VAG16080536">VIVIAN PARADERO</option>
                                                        <option value="VAG11101407">VOLTAIRE RODOLO VICTORIA</option>
                                                        <option value="VAG14060943">WILAINE AUDREY T. CHUA</option>
                                                        <option value="VAG17082996">WILFREDO QUITIONGCO</option>
                                                        <option value="VAG11010646">WILFREDO TALACTAC ENRIQUEZ</option>
                                                        <option value="VAG02010381">WILHELMENA LAURENIO SILVESTRE</option>
                                                        <option value="VAG14060953">WILIANNE AUBREY T. CHUA</option>
                                                        <option value="VAG21123199">WILLIAM B. DIZON</option>
                                                        <option value="VAG11082657">WILLIAM JASARINO</option>
                                                        <option value="VAG11012189">WILMA R. DE GUZMAN</option>
                                                        <option value="VAG13081903">YOLANDA ANG</option>
                                                        <option value="VAG19062576">YOLANDA S. SANTOS</option>
                                                        <option value="VAG12102250">YOLANDA Y. SACDALAN</option>
                                                        <option value="VAG21123201">YU PING L. CHUA</option>
                                                        <option value="VAG02010394">ZALDY C. BACOLOD</option>
                                                        <option value="VAG17060215">ZARA APOLINARIO</option>
                                                        <option value="VAG11092282">ZENAIDA ABLAZA DELA CRUZ</option>
                                                        <option value="VAG11020330">ZENAIDA DELA CRUZ</option>
                                                        <option value="VAG11051899">ZENAIDA ESCALER</option>
                                                        <option value="VAG11012192">ZENAIDA M MANANGAN</option>
                                                        <option value="VAG11120541">ZENAIDA ROCA BALENTON</option>
                                                        <option value="VAG16080950">ZISA CELIA S. PEREYRA</option>
                                                        <option value="VAG02010384">ZITA SY TAN</option>
                                                    </select>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="error-name_of_business"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Created By <span class="text-danger">*</span></label>
                                                    <input type="text" name="created_by" id="created_by" class="form-control" />
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="error-created_by"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Account Manager <span class="text-danger">*</span></label>
                                                    <select name="account_manager" id="account_manager" class="select2 form-control" style="width: 100%">
                                                        <option value="" selected="" disabled="">Select Account Manager</option>
                                                        <option value="ALBERT GABRIEL P. LUCAS">ALBERT GABRIEL P. LUCAS</option>
                                                        <option value="ANDRE BELTRAN">ANDRE BELTRAN</option>
                                                        <option value="ANGELICA A. ABLA">ANGELICA A. ABLA</option>
                                                        <option value="ANN MISTYCA R. GANDALLA">ANN MISTYCA R. GANDALLA</option>
                                                        <option value="ARGELLIN JOY B. FRIAS">ARGELLIN JOY B. FRIAS</option>
                                                        <option value="AVEGAIL D. BUENAMENTE">AVEGAIL D. BUENAMENTE</option>
                                                        <option value="BELLY D. BERGANTINOS">BELLY D. BERGANTINOS</option>
                                                        <option value="CARR XERXEL M. ROSALES">CARR XERXEL M. ROSALES</option>
                                                        <option value="CATHERINE M. CASTILLO">CATHERINE M. CASTILLO</option>
                                                        <option value="CHESTER A. COSTINAR">CHESTER A. COSTINAR</option>
                                                        <option value="CLAIRE JUSTINE A. DEE">CLAIRE JUSTINE A. DEE</option>
                                                        <option value="DARRELL D. RAYMUNDO">DARRELL D. RAYMUNDO</option>
                                                        <option value="DENISE CAMILLE O. ALIMAN">DENISE CAMILLE O. ALIMAN</option>
                                                        <option value="FRANZ GERALD G. FABIC">FRANZ GERALD G. FABIC</option>
                                                        <option value="GERARD DAVE B. REYES">GERARD DAVE B. REYES</option>
                                                        <option value="HIEDILIZA E. ISON">HIEDILIZA E. ISON</option>
                                                        <option value="JANE KAYEN V. LOPEZ">JANE KAYEN V. LOPEZ</option>
                                                        <option value="JANICLEAR E. CAHILIG">JANICLEAR E. CAHILIG</option>
                                                        <option value="JANINE P. DUMANAT">JANINE P. DUMANAT</option>
                                                        <option value="JANUS PAUL F. RAMOS">JANUS PAUL F. RAMOS</option>
                                                        <option value="JASMIN N. AMAR">JASMIN N. AMAR</option>
                                                        <option value="JAYVAN S. BRACAMONTE">JAYVAN S. BRACAMONTE</option>
                                                        <option value="JENNIFER MICHELLE A. AGPALO">JENNIFER MICHELLE A. AGPALO</option>
                                                        <option value="JENNY I. FABIAN">JENNY I. FABIAN</option>
                                                        <option value="JERLYN C. OCAB">JERLYN C. OCAB</option>
                                                        <option value="JESAMAE G. BALIDOY">JESAMAE G. BALIDOY</option>
                                                        <option value="JESSIE LEONNE L. VALENZUELA">JESSIE LEONNE L. VALENZUELA</option>
                                                        <option value="JOAN J. SEDANO">JOAN J. SEDANO</option>
                                                        <option value="JOANA MARIE A. ALBINDO">JOANA MARIE A. ALBINDO</option>
                                                        <option value="JONAH FLOR M. ARA�A">JONAH FLOR M. ARAÑA</option>
                                                        <option value="JOY L. CAPISTRANO">JOY L. CAPISTRANO</option>
                                                        <option value="KATHLEEN H. ROSALES">KATHLEEN H. ROSALES</option>
                                                        <option value="LEAH MAE C. ALCANTARA">LEAH MAE C. ALCANTARA</option>
                                                        <option value="LECILE H. DELOS SANTOS">LECILE H. DELOS SANTOS</option>
                                                        <option value="MA. ISABEL M. VASQUEZ">MA. ISABEL M. VASQUEZ</option>
                                                        <option value="MARIA JOSEPHINE S. BANATO">MARIA JOSEPHINE S. BANATO</option>
                                                        <option value="MARIA KRISTINE A. VILLENA">MARIA KRISTINE A. VILLENA</option>
                                                        <option value="MARIA L.D. MONGE">MARIA L.D. MONGE</option>
                                                        <option value="MARICEL L. INDEMNE">MARICEL L. INDEMNE</option>
                                                        <option value="MARY ANN S. TUGANO">MARY ANN S. TUGANO</option>
                                                        <option value="MARY GRACE O. MANALUZ">MARY GRACE O. MANALUZ</option>
                                                        <option value="MARY ROSE ANNE P. EBORA">MARY ROSE ANNE P. EBORA</option>
                                                        <option value="MARYNETH Q. RAMIREZ">MARYNETH Q. RAMIREZ</option>
                                                        <option value="MAYLENE FAJURA">MAYLENE FAJURA</option>
                                                        <option value="RAILYN G. BILDAN">RAILYN G. BILDAN</option>
                                                        <option value="RAYNALD GENE P. SIBALON">RAYNALD GENE P. SIBALON</option>
                                                        <option value="RICH ANDREW B.CARMONA">RICH ANDREW B.CARMONA</option>
                                                        <option value="RIZALYN G. ALBACINO">RIZALYN G. ALBACINO</option>
                                                        <option value="RONALYN L. VANZUELA">RONALYN L. VANZUELA</option>
                                                        <option value="SALVE MAE R. LANON">SALVE MAE R. LANON</option>
                                                        <option value="SHARICE R. SUNGLAO">SHARICE R. SUNGLAO</option>
                                                        <option value="SHELLY D. PALOMAREZ">SHELLY D. PALOMAREZ</option>
                                                        <option value="SHEMIRAH MAE A. RAMOSO">SHEMIRAH MAE A. RAMOSO</option>
                                                        <option value="SHIELA MAE M. PE�A">SHIELA MAE M. PEÑA</option>
                                                        <option value="TRISTAN LLOYD P. SOLANCHO">TRISTAN LLOYD P. SOLANCHO</option>
                                                        <option value="VAUGHN LOUISE GUERRERO">VAUGHN LOUISE GUERRERO</option>
                                                        <option value="VIA MARIE C. MONTA">VIA MARIE C. MONTA</option>
                                                        <option value="VIENNA MARIE M. MADELO">VIENNA MARIE M. MADELO</option>
                                                    </select>



                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="error-account_manager"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Sales/Team Manager <span class="text-danger">*</span></label>
                                                    <select name="sales_teams_manager" id="sales_teams_manager" class="select2 form-control" style="width: 100%">
                                                        <option value="" selected="" disabled="">Sales/Team Manager</option>
                                                        <option value="MARIA JOSEPHINE S. BANATO">MARIA JOSEPHINE S. BANATO</option>
                                                        <option value="MARIA KRISTINE A. VILLENA">MARIA KRISTINE A. VILLENA</option>
                                                    </select>

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="error-sales_teams_manager"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Sales Remarks</label>
                                                    <textarea class="form-control" name="sales_remarks" id="sales_remarks" col="60" row="60"></textarea>

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="error-sales_remarks"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">ACUSA Remarks</label>
                                                    <textarea class="form-control" name="acusa_remarks" id="acusa_remarks" col="60" row="60"></textarea>

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="error-acusa_remarks"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <hr class="bg-primary">
                                                <h5>Attachment Files</h5>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="control-label">Application Form</label>
                                                    <input type="file" class="form-control" id="application_form" name="application_form">

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="error-application_form"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="control-label">Conforme</label>
                                                    <input type="file" class="form-control" id="conforme" name="conforme">

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="error-conforme"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="control-label">Valid ID</label>
                                                    <input type="file" class="form-control" id="valid_id" name="valid_id">

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="error-valid_id"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary text-uppercase" id="endorce_to_mda_submit">Endorce to MDA</button>
                </div>

            </div>
        </div>
    </div>
</form>




@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('.datatable-table').DataTable({
            pageLength: 10,
            "scrollX": true,
            "scrollY": true,
            "sScrollXInner": "100%",
            "sScrollYInner": "100%",
            "sScrollY": "500",
            "bDestroy": true,
            buttons: [],
        })
    });

    $('#receipt_data').on("click", '.view_uploaded_id', function(event) {
        var image = $(this).attr('image');
        console.log(image)
        $('#modalViewImage').modal('show')
        $('#img_file').attr('src', '/uploadedReceipts/' + image);
    });
    var memberID = "";
    $('.select_endorse_to').on("change", function(event) {
        var endorseTo = $(this).val();
        memberID = $(this).attr('member');
        console.log(memberID);
        if (endorseTo == "MDA") {
            viewIFGForm(memberID);
            $('#modalIFG').modal('show');
        } else {
            $.confirm({
                title: 'Confirmation',
                content: 'You really want to endorce to ' + endorseTo + ' ?',
                type: 'blue',
                buttons: {
                    confirm: {
                        text: 'confirm',
                        btnClass: 'btn-blue',
                        keys: ['enter', 'shift'],
                        action: function() {
                            return $.ajax({
                                url: "/admin/endorse_to/" + memberID + "/" + endorseTo,
                                method: 'PUT',
                                data: {
                                    _token: '{!! csrf_token() !!}',
                                },
                                dataType: "json",
                                beforeSend: function() {

                                },
                                success: function(data) {
                                    return alertPopup(data.success, 'success');
                                }
                            })
                        }
                    },
                    cancel: {
                        text: 'cancel',
                        btnClass: 'btn-red',
                        keys: ['enter', 'shift'],
                        action: function() {
                            location.reload();
                        }
                    }
                }
            });
        }


    });


    $('.view_quatation').on("click", function(event) {
        memberID = $(this).attr('member');
        viewQuatation(memberID);
    });


    function viewQuatation(id) {
        $.ajax({
            url: "/admin/quatation/" + id,
            dataType: "json",
            beforeSend: function() {},
            success: function(data) {
                console.log(data.result);
                $.each(data.result, function(key, value) {
                    console.log(value.isQuatation);
                    if (key == 'isQuatation') {
                        if (value == false) {
                            $.confirm({
                                title: 'Confirmation',
                                content: 'This member does not currently have a quotation. ',
                                type: 'red',
                                buttons: {
                                    confirm: {
                                        text: 'confirm',
                                        btnClass: 'btn-blue',
                                        keys: ['enter', 'shift'],
                                        action: function() {

                                        }
                                    },

                                }
                            });
                        } else {
                            $('#modalQuatation').modal('show')
                        }
                    }


                    if (key == 'subtotal') {
                        $('.subtotal').text(value);
                    }
                    if (key == 'total') {
                        $('.total').text(value);
                    }


                    if (key == 'principal') {
                        var princ = '';
                        princ += `
                            <tr>
                                <td>` + value.item + `</td>
                                <td>` + value.amount + `</td>
                            </tr>
                        `;

                        $('#principal_charge').empty().append(princ);
                    }
                    if (key == 'dependents') {
                        var depend = "";
                        $.each(value, function(key, value) {
                            depend += `
                                <tr>
                                    <td>` + value.item + `</td>
                                    <td>` + value.amount + `</td>
                                </tr>
                            `;
                        });
                        $('#dependents_charge').empty().append(depend);
                    }
                    if (key == 'charges') {
                        var charge = "";
                        $.each(value, function(key, value) {
                            charge += `
                                <tr>
                                    <td>` + value.item + `</td>
                                    <td>` + value.amount + `</td>
                                </tr>
                            `;
                        });
                        $('#charge_section').empty().append(charge);
                    }
                    if (key == 'name') {
                        $('.account_name').text(value)
                    }

                    if (key == 'receipt_data') {
                        console.log(value);
                        if (value.length == 0) {
                            $(".payment_details_section").hide();
                        } else {
                            $(".payment_details_section").show();
                            var receipt_datas = "";
                            var paymentColor = value.payment_status == 'PAYMENT REVIEW' ? 'badge-warning' : 'badge-success';
                            receipt_datas += `
                                <tr>
                                    <td>
                                            Payment Status
                                    </td>
                                    <td>
                                         <h5>  <span class="badge  ` + paymentColor + `">` + value.payment_status + `</span> </h5>
                                    </td>
                                </tr>
                            <tr>
                                <td>
                                        File Uploaded
                                </td>
                                <th  style="cursor: pointer;" class="text-info view_uploaded_id" image="` + value.file_uploaded + `">
                                     View Uploaded Image
                                </th>
                            </tr>
                            <tr>
                                <td>
                                        Reference Number
                                </td>
                            <th>
                                            ` + value.reference_number + `
                                </th>
                            </tr>
                            <tr>
                                <td>
                                        Amount Paid
                                </td>
                                <th>
                                            ` + value.amount_paid + `
                                </th>
                            </tr>
                            <tr>
                                <td>
                                        Date Upload
                                </td>
                                <th>
                                            ` + value.date_uploaded + `
                                </th>
                            </tr>
                        `;
                            $('#receipt_data').empty().append(receipt_datas);
                        }
                    }

                    if (key == 'uploaded_by') {
                        $('.quatation_uploaded_by').text(value.quatation_uploaded_by);
                        $('.last_send_email_for_quatation').text(value.last_send_email_for_quatation);
                        $('.last_send_email_for_payment').text(value.last_send_email_for_payment);
                        $('.approved_by_accounting').text(value.approved_by_accounting);
                    }
                })
            }
        })
    }

    $('.notify_member').on("click", function(event) {

        $.confirm({
            title: 'Confirmation',
            content: 'You really want to notify this member ?',
            type: 'blue',
            buttons: {
                confirm: {
                    text: 'confirm',
                    btnClass: 'btn-blue',
                    keys: ['enter', 'shift'],
                    action: function() {
                        return $.ajax({
                            url: "/admin/admin_sales/notify/" + memberID,
                            method: 'POST',
                            data: {
                                _token: '{!! csrf_token() !!}',
                            },
                            dataType: "json",
                            beforeSend: function() {
                                $(".notify_member").attr("disabled", true);
                            },
                            success: function(data) {
                                $(".notify_member").attr("disabled", false);
                                return alertPopup(data.success, 'success');
                            }
                        })
                    }
                },
                cancel: {
                    text: 'cancel',
                    btnClass: 'btn-red',
                    keys: ['enter', 'shift'],

                }
            }
        });
    });

    $('.notify_member_payment').on("click", function(event) {
        $.confirm({
            title: 'Confirmation',
            content: 'You really want to notify this member ?',
            type: 'blue',
            buttons: {
                confirm: {
                    text: 'confirm',
                    btnClass: 'btn-blue',
                    keys: ['enter', 'shift'],
                    action: function() {
                        return $.ajax({
                            url: "/admin/admin_sales/notify_payment/" + memberID,
                            method: 'POST',
                            data: {
                                _token: '{!! csrf_token() !!}',
                            },
                            dataType: "json",
                            beforeSend: function() {
                                $(".notify_member_payment").attr("disabled", true);
                            },
                            success: function(data) {
                                $(".notify_member_payment").attr("disabled", false);

                                $.confirm({
                                    title: "",
                                    content: data.success + '<br><br> Do you want to endorce this member to MDA department?',
                                    type: 'green',
                                    buttons: {
                                        confirm: {
                                            text: 'confirm',
                                            btnClass: 'btn-blue',
                                            keys: ['enter', 'shift'],
                                            action: function() {
                                                $('#modalQuatation').modal('hide')
                                                $('#modalIFG').modal('show');
                                                viewIFGForm(memberID);

                                            }
                                        },
                                        cancel: {
                                            text: 'cancel',
                                            btnClass: 'btn-red',
                                            keys: ['enter', 'shift'],

                                        }
                                    }
                                });
                            }
                        })
                    }
                },
                cancel: {
                    text: 'cancel',
                    btnClass: 'btn-red',
                    keys: ['enter', 'shift'],

                }
            }
        });
    });


    function viewIFGForm(id) {
        $.ajax({
            url: "/admin/ifgForm/" + id,
            dataType: "json",
            beforeSend: function() {},
            success: function(data) {
                $.each(data.result, function(key, value) {
                    if (key == "mem_count") {
                        $('#mem_count').val(value)
                    }
                    if (key == "name") {
                        $('#name').val(value)
                    }
                    if (key == "billing_address") {
                        $("#billing_address").val(value);
                    }
                    if (key == "contact_number") {
                        $("#contact_number").val(value);
                    }
                    if (key == "request_by") {
                        $("#request_by").val(value);
                        $("#created_by").val(value);
                    }
                    if (key == "department") {
                        $("#department").val(value);
                    }

                });

            }
        })
    }

    $('#ifgForm').on('submit', function(event) {
        event.preventDefault();
        $('.form-control').removeClass('is-invalid');
        $.ajax({
            url: "/admin/ifgForm/" + memberID,
            method: "POST",
            dataType: "json",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#endorce_to_mda_submit").attr("disaled", true);
            },
            success: function(data) {
                $("#endorce_to_mda_submit").attr("disabled", false);
                return alertPopup(data.success, 'success');
            }
        });

    });
</script>
@endsection