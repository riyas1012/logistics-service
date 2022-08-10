@extends('layouts.base')

@section('content')
    @include('layouts.header', ['header_name' => 'Logistics Service Request Form'])
    <form action="" class="form-horizontal">
        <div class="container" style="padding:30px 0px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    Requestor Information
                                </div>
                                <div class="col-md-6">
                                    <a href="{{route('logout')}}"  class="btn btn-success pull-right">
                                        Logout
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="col-md-4 control-label">
                                            Name :
                                        </label>
                                        <div class="col-md-8">
                                            <input type="text" name="name" id="name" placeholder="Name"
                                                class="form-control input-md" />
                                            @error('name')
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="col-md-4 control-label">
                                            Email :
                                        </label>
                                        <div class="col-md-8">
                                            <input type="email" name="email" id="email" placeholder="Email"
                                                class="form-control input-md" />
                                            @error('email')
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="project_functional_area" class="col-md-4 control-label">
                                            Project/Functional Area :
                                        </label>
                                        <div class="col-md-8">
                                            <input type="text" name="project_functional_area"
                                                id="project_functional_area" placeholder="Project/Functional Area"
                                                class="form-control input-md" />
                                            @error('project_functional_area')
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile" class="col-md-4 control-label">
                                            Mobile :
                                        </label>
                                        <div class="col-md-8">
                                            <input type="text" name="mobile" id="mobile" placeholder="Mobile"
                                                class="form-control input-md" />
                                            @error('mobile')
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="job_title" class="col-md-4 control-label">
                                            Job Title :
                                        </label>
                                        <div class="col-md-8">
                                            <input type="text" name="job_title" id="job_title" placeholder="Job Title"
                                                class="form-control input-md" />
                                            @error('job_title')
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="service" class="col-md-3 control-label">
                                            Service :
                                        </label>
                                        <div class="col-md-9">
                                            <input type="radio" name="service" value="1" /> <span> Warehouse Storage
                                                Space </span> <br>
                                            <input type="radio" name="service" value="2" /> <span> Transportation of
                                                Goods to Venues</span> <br>
                                            <input type="radio" name="service" value="3" /> <span> On-Venue
                                                Assistance* (Crew, MHE, Other Venue Support)</span> <br>
                                            @error('service')
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" id="warehouse_storage_space" style="padding:5px 0px;display:none;">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Warehouse Storage Space
                        </div>
                        <div class="panel-body">
                            <div class="row m-left-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description_of_materials" class="control-label">
                                            Description of Materials :
                                        </label>
                                        <input type="text" name="description_of_materials" id="description_of_materials"
                                            placeholder="E.g.: Brown Foldable Plastic Tables 1.5x.3m"
                                            class="form-control input-width" />
                                        @error('description_of_material')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row m-left-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type_of_storage" class="control-label">
                                            Type of Storage Required :
                                        </label>
                                        <select class="form-control input-width" name="storage_type_id"
                                            id="storage_type_id">
                                            <option value="">Select Storage Type</option>
                                            @foreach ($storage_types as $storageType)
                                                <option value="{{ $storageType->id }}">{{ $storageType->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('storage_type_id')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="quantity_of_items" class="control-label">
                                            Quantity of items :
                                        </label>
                                        <input type="number" name="quantity_of_items" id="quantity_of_items"
                                            placeholder="e.g.: 200" class="form-control input-width" />
                                        @error('quantity_of_items')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row m-left-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="goods_preparation_type_id" class="control-label">
                                            How will the goods be prepared? :
                                        </label>
                                        <select class="form-control input-width" name="goods_preparation_type_id "
                                            id="goods_preparation_type_id">
                                            <option value="">Select Goods Preparation Type</option>
                                            @foreach ($goods_preparation_types as $goodsPreparationTypes)
                                                <option value="{{ $goodsPreparationTypes->id }}">
                                                    {{ $goodsPreparationTypes->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('goods_preparation_type_id')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_of_packaged_goods" class="control-label">
                                            Number of packaged goods :
                                        </label>
                                        <input type="number" name="no_of_packaged_goods" id="no_of_packaged_goods"
                                            placeholder="e.g.: 200" class="form-control input-width" />
                                        @error('no_of_packaged_goods')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row m-left-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="packaging_specifications" class="control-label">
                                            Packaging specifications :
                                        </label>
                                        <input type="text" name="packaging_specifications"
                                            id="packaging_specifications"
                                            placeholder="Please specify if the dimensions are per unit/box/pallet"
                                            class="form-control input-width" />
                                        @error('packaging_specifications')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row m-left-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="weight_of_goods" class="control-label">
                                            Weight of goods :
                                        </label>
                                        <input type="text" name="weight_of_goods" id="weight_of_goods"
                                            placeholder="Please specify if the weight is per unit/box/pallet or total"
                                            class="form-control input-width" />
                                        @error('weight_of_goods')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row m-left-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="storage_start_date" class="control-label">
                                            Storage Start Date :
                                        </label>
                                        <input type="text" name="storage_start_date" id="storage_start_date"
                                            placeholder="YYYY/MM/DD" class="form-control input-width" />
                                        @error('storage_start_date')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">
                                            Storage End Date :
                                        </label>
                                        <input type="text" name="storage_end_date" id="storage_end_date"
                                            placeholder="YYYY/MM/DD" class="form-control input-width" />
                                        @error('storage_end_date')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row m-left-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="any_dangerous" class="control-label">
                                            Are there any Dangerous or Hazardous Goods? :
                                        </label>
                                        <select class="form-control input-width" name="any_dangerous" id="any_dangerous">
                                            <option value="">-- Select --</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                        @error('goods_preparation_type_id')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6" id="dangerous_details_div" style="display: none;">
                                    <div class="form-group">
                                        <label for="dangerous_details" class="control-label">
                                            If YES, Please specify :
                                        </label>
                                        <input type="text" name="dangerous_details" id="dangerous_details"
                                            placeholder="If YES, Please specify" class="form-control input-width" />
                                        @error('dangerous_details')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row m-left-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dissolution_plan_place" class="control-label">
                                            Is there a dissolution plan in place? :
                                        </label>
                                        <select class="form-control input-width" name="dissolution_plan_place"
                                            id="dissolution_plan_place">
                                            <option value="">-- Select --</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                        @error('dissolution_plan_place')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6" id="dissolution_plan_details_div" style="display: none;">
                                    <div class="form-group">
                                        <label for="dissolution_plan_details" class="control-label">
                                            If YES, Please specify :
                                        </label>
                                        <input type="text" name="dissolution_plan_details"
                                            id="dissolution_plan_details" placeholder="If YES, Please specify"
                                            class="form-control input-width" />
                                        @error('dissolution_plan_details')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row m-left-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="special_handling_requirements" class="control-label">
                                            Any special handling requirements from the supplier? :
                                        </label>
                                        <select class="form-control input-width" name="special_handling_requirements"
                                            id="special_handling_requirements">
                                            <option value="">-- Select --</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                        @error('special_handling_requirements')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6" id="special_handling_details_div" style="display: none;">
                                    <div class="form-group">
                                        <label for="special_handling_details" class="control-label">
                                            If YES, Please specify :
                                        </label>
                                        <input type="text" name="special_handling_details"
                                            id="special_handling_details" placeholder="If YES, Please specify"
                                            class="form-control input-width" />
                                        @error('special_handling_details')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row m-left-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="transport_to_deliver" class="control-label">
                                            Will you provide the transport to deliver this to the Warehouse? :
                                        </label>
                                        <select class="form-control input-width" name="transport_to_deliver"
                                            id="transport_to_deliver">
                                            <option value="">-- Select --</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                        @error('transport_to_deliver')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6" id="transport_to_deliver_details_div" style="display: none;">
                                    <div class="form-group">
                                        <label for="transport_to_deliver_details" class="control-label">
                                            If YES, Please specify :
                                        </label>
                                        <input type="text" name="transport_to_deliver_details"
                                            id="transport_to_deliver_details" placeholder="If YES, Please specify"
                                            class="form-control input-width" />
                                        @error('transport_to_deliver_details')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row m-left-20" id="collection_details_div" style="display: none;">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date_of_collection" class="control-label">
                                            Date of collection :
                                        </label>
                                        <input type="text" name="date_of_collection" id="date_of_collection"
                                            placeholder="YYYY/MM/DD" class="form-control collection-input-width" />
                                        @error('date_of_collection')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="location_of_collection" class="control-label">
                                            Central Location of collection :
                                        </label>
                                        <input type="text" name="location_of_collection" id="location_of_collection"
                                            placeholder="Central Location of collection"
                                            class="form-control collection-input-width" />
                                        @error('location_of_collection')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="collection_contact_person" class="control-label">
                                            Contact person and number :
                                        </label>
                                        <input type="text" name="collection_contact_person"
                                            id="collection_contact_person" placeholder="Central Location of collection"
                                            class="form-control collection-input-width" />
                                        @error('location_of_collection')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row m-left-20">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="venues_distribution" class="control-label">
                                            At the end of the requested storage period, do you require Logistics to provide
                                            the distribution to venues for the items? :
                                        </label>
                                        <select class="form-control input-width" name="venues_distribution"
                                            id="venues_distribution">
                                            <option value="">-- Select --</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                        @error('venues_distribution')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row m-left-20" id="venue_details_div" style="display: none;">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="venues_distribution_date" class="control-label">
                                            Date :
                                        </label>
                                        <input type="text" name="venues_distribution_date"
                                            id="venues_distribution_date" placeholder="YYYY/MM/DD"
                                            class="form-control collection-input-width" />
                                        @error('venues_distribution_date')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="venues_distribution_place" class="control-label">
                                            Venue :
                                        </label>
                                        <input type="text" name="venues_distribution_place"
                                            id="venues_distribution_place" placeholder="Central Location of collection"
                                            class="form-control collection-input-width" />
                                        @error('venues_distribution_place')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="venues_distribution_contact" class="control-label">
                                            Contact person and number :
                                        </label>
                                        <input type="text" name="venues_distribution_contact"
                                            id="venues_distribution_contact" placeholder="Central Location of collection"
                                            class="form-control collection-input-width" />
                                        @error('venues_distribution_contact')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" id="transportation_goods_to_venues" style="padding:5px 0px;display:none;">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Transportation of Goods to Venues
                        </div>
                        <div class="panel-body">
                            test
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" id="on_venue_assistance" style="padding:5px 0px;display:none;">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            On-Venue Assistance* (Crew, MHE, Other Venue Support)
                        </div>
                        <div class="panel-body">
                            test
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="submit" class="col-md-6 control-label"></label>
            <div class="col-md-4">
                <button class="btn btn-primary" disabled>Submit</button>
            </div>
        </div>
    </form>
    @push('scripts')
        <script>
            $(function() {
                $('#storage_start_date').datetimepicker({
                    format: 'Y-MM-DD',
                });
                $('#storage_end_date').datetimepicker({
                    format: 'Y-MM-DD',
                });
                $('#date_of_collection').datetimepicker({
                    format: 'Y-MM-DD',
                });
                $('#venues_distribution_date').datetimepicker({
                    format: 'Y-MM-DD',
                });
            });
            $('input:radio[name="service"]').change(
                function() {
                    if (this.checked && this.value == '1') {
                        $("#warehouse_storage_space").show();
                        $("#transportation_goods_to_venues").hide();
                        $("#on_venue_assistance").hide();
                    } else if (this.checked && this.value == '2') {
                        $("#warehouse_storage_space").hide();
                        $("#transportation_goods_to_venues").show();
                        $("#on_venue_assistance").hide();
                    } else if (this.checked && this.value == '3') {

                        $("#warehouse_storage_space").hide();
                        $("#transportation_goods_to_venues").hide();
                        $("#on_venue_assistance").show();
                    } else {
                        $("#warehouse_storage_space").hide();
                        $("#transportation_goods_to_venues").hide();
                        $("#on_venue_assistance").hide();
                    }
                });
            $('#any_dangerous').on('change', function() {
                if (this.value == 'Yes') {
                    $("#dangerous_details_div").show();
                } else {
                    $("#dangerous_details_div").hide();
                }
            });
            $('#dissolution_plan_place').on('change', function() {
                if (this.value == 'Yes') {
                    $("#dissolution_plan_details_div").show();
                } else {
                    $("#dissolution_plan_details_div").hide();
                }
            });
            $('#special_handling_requirements').on('change', function() {
                if (this.value == 'Yes') {
                    $("#special_handling_details_div").show();
                } else {
                    $("#special_handling_details_div").hide();
                }
            });
            $('#transport_to_deliver').on('change', function() {
                if (this.value == 'Yes') {
                    $("#transport_to_deliver_details_div").show();
                    $("#collection_details_div").hide();
                } else if (this.value == 'No') {
                    $("#transport_to_deliver_details_div").hide();
                    $("#collection_details_div").show();
                } else {
                    $("#transport_to_deliver_details_div").hide();
                    $("#collection_details_div").hide();
                }
            });

            $('#venues_distribution').on('change', function() {
                if (this.value == 'Yes') {
                    $("#venue_details_div").show();
                } else {
                    $("#venue_details_div").hide();
                }
            });
        </script>
    @endpush
@endsection
