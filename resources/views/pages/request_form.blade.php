@extends('layouts.base')

@section('content')
    @push('stylesheet')
        <style>
            .error {
                color: red;
            }
        </style>
    @endpush
    @include('layouts.header', ['header_name' => 'Logistics Service Request Form'])
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    <form action="{{ route('request.form.create') }}" class="form-horizontal" method="POST" name="applicationForm"
        id="applicationForm">
        @csrf
        <div class="container" style="padding:30px 0px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    Requestor Information
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('service.request') }}" class="btn btn-success pull-right">
                                        All Request
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('logout') }}" class="btn btn-success pull-right">
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
                                                class="form-control input-md" value="{{ old('name') }}" />
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
                                            <input type="email" value="{{ old('email') }}" name="email" id="email"
                                                placeholder="Email" class="form-control input-md" />
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
                                                class="form-control input-md"
                                                value="{{ old('project_functional_area') }}" />
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
                                                class="form-control input-md" value="{{ old('mobile') }}" />
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
                                            <input type="text" name="job_title" value="{{ old('job_title') }}"
                                                id="job_title" placeholder="Job Title" class="form-control input-md" />
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
                                            <input type="radio" name="service" value="1"
                                                @if (old('service') == 1) checked @endif /> <span> Warehouse Storage
                                                Space </span> <br>
                                            <input type="radio" name="service" value="2"
                                                @if (old('service') == 2) checked @endif /> <span> Transportation of
                                                Goods to Venues</span> <br>
                                            <input type="radio" name="service" value="3"
                                                @if (old('service') == 3) checked @endif /> <span> On-Venue
                                                Assistance* (Crew, MHE, Other Venue Support)</span> <br>
                                            <label id="service-error" class="error" for="service"></label>
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
                                        <input type="text" name="description_of_materials"
                                            id="description_of_materials"
                                            placeholder="E.g.: Brown Foldable Plastic Tables 1.5x.3m"
                                            class="form-control input-width"
                                            value="{{ old('description_of_materials') }}" />
                                        @error('description_of_materials')
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
                                                <option @if (old('storage_type_id') == $storageType->id) selected @endif
                                                    value="{{ $storageType->id }}">{{ $storageType->name }}</option>
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
                                        <input type="number" min="1" name="quantity_of_items"
                                            id="quantity_of_items" placeholder="e.g.: 200"
                                            class="form-control input-width" value="{{ old('quantity_of_items') }}" />
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
                                        <select class="form-control input-width" name="goods_preparation_type_id"
                                            id="goods_preparation_type_id">
                                            <option value="">Select Goods Preparation Type</option>
                                            @foreach ($goods_preparation_types as $goodsPreparationTypes)
                                                <option @if (old('goods_preparation_type_id') == $goodsPreparationTypes->id) selected @endif
                                                    value="{{ $goodsPreparationTypes->id }}">
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
                                        <input type="number" min="1" name="no_of_packaged_goods"
                                            id="no_of_packaged_goods" placeholder="e.g.: 200"
                                            class="form-control input-width" value="{{ old('no_of_packaged_goods') }}" />
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
                                            class="form-control input-width"
                                            value="{{ old('packaging_specifications') }}" />
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
                                            class="form-control input-width" value="{{ old('weight_of_goods') }}" />
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
                                            placeholder="YYYY/MM/DD" class="form-control input-width"
                                            value="{{ old('storage_start_date') }}" />
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
                                            placeholder="YYYY/MM/DD" class="form-control input-width"
                                            value="{{ old('storage_end_date') }}" />
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
                                        <br>
                                        {{-- <select class="form-control input-width" name="any_dangerous" id="any_dangerous">
                                            <option value="">-- Select --</option>
                                            <option @if (old('any_dangerous') == 'Yes') selected @endif value="Yes">Yes
                                            </option>
                                            <option @if (old('any_dangerous') == 'No') selected @endif value="No">No
                                            </option>
                                        </select> --}}

                                        <input type="radio" @if (old('any_dangerous') == 'Yes') checked @endif
                                            id="any_dangerous_yes" name="any_dangerous" value="Yes">
                                        <label for="any_dangerous_yes">Yes</label><br>
                                        <input type="radio" @if (old('any_dangerous') == 'No') checked @endif
                                            id="any_dangerous_no" name="any_dangerous" value="No">
                                        <label for="any_dangerous_no">No</label><br>
                                        <label id="any_dangerous-error" class="error" for="any_dangerous"></label>
                                        @error('any_dangerous')
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
                                            placeholder="If YES, Please specify" class="form-control input-width"
                                            value="{{ old('dangerous_details') }}" />
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
                                        {{-- <select class="form-control input-width" name="dissolution_plan_place"
                                            id="dissolution_plan_place">
                                            <option value="">-- Select --</option>
                                            <option @if (old('dissolution_plan_place') == 'Yes') selected @endif value="Yes">Yes
                                            </option>
                                            <option @if (old('dissolution_plan_place') == 'No') selected @endif value="No">No
                                            </option>
                                        </select> --}}
                                        <br>
                                        <input type="radio" @if (old('dissolution_plan_place') == 'Yes') checked @endif
                                            id="dissolution_plan_place_yes" name="dissolution_plan_place" value="Yes">
                                        <label for="dissolution_plan_place_yes">Yes</label><br>
                                        <input type="radio" @if (old('dissolution_plan_place') == 'No') checked @endif
                                            id="dissolution_plan_place_no" name="dissolution_plan_place" value="No">
                                        <label for="dissolution_plan_place_no">No</label><br>
                                        <label id="dissolution_plan_place-error" class="error"
                                            for="dissolution_plan_place"></label>
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
                                            class="form-control input-width"
                                            value="{{ old('dissolution_plan_details') }}" />
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
                                        {{-- <select class="form-control input-width" name="special_handling_requirements"
                                            id="special_handling_requirements">
                                            <option value="">-- Select --</option>
                                            <option @if (old('special_handling_requirements') == 'Yes') selected @endif value="Yes">Yes
                                            </option>
                                            <option @if (old('special_handling_requirements') == 'No') selected @endif value="No">No
                                            </option>
                                        </select> --}}
                                        <br>
                                        <input type="radio" @if (old('special_handling_requirements') == 'Yes') checked @endif
                                            id="special_handling_requirements_yes" name="special_handling_requirements"
                                            value="Yes">
                                        <label for="special_handling_requirements_yes">Yes</label><br>
                                        <input type="radio" @if (old('special_handling_requirements') == 'No') checked @endif
                                            id="special_handling_requirements_no" name="special_handling_requirements"
                                            value="No">
                                        <label for="special_handling_requirements_no">No</label><br>
                                        <label id="special_handling_requirements-error" class="error"
                                            for="special_handling_requirements"></label>
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
                                            class="form-control input-width"
                                            value="{{ old('dissolution_plan_details') }}" />
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
                                        {{-- <select class="form-control input-width" name="transport_to_deliver"
                                            id="transport_to_deliver">
                                            <option value="">-- Select --</option>
                                            <option @if (old('transport_to_deliver') == 'Yes') selected @endif value="Yes">Yes
                                            </option>
                                            <option @if (old('transport_to_deliver') == 'No') selected @endif value="No">No
                                            </option>
                                        </select> --}}
                                        <br>
                                        <input type="radio" @if (old('transport_to_deliver') == 'Yes') checked @endif
                                            id="transport_to_deliver_yes" name="transport_to_deliver" value="Yes">
                                        <label for="transport_to_deliver_yes">Yes</label><br>
                                        <input type="radio" @if (old('transport_to_deliver') == 'No') checked @endif
                                            id="transport_to_deliver_no" name="transport_to_deliver" value="No">
                                        <label for="transport_to_deliver_no">No</label><br>
                                        <label id="transport_to_deliver-error" class="error"
                                            for="transport_to_deliver"></label>
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
                                            Expected delivery date time :
                                        </label>
                                        {{-- <input type="text" name="transport_to_deliver_details"
                                            id="transport_to_deliver_details" placeholder="If YES, Please specify"
                                            class="form-control input-width"
                                            value="{{ old('transport_to_deliver_details') }}" />
                                            @error('transport_to_deliver_details')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror --}}
                                        <input type="text" name="expected_delivetr_dttm" id="expected_delivetr_dttm"
                                            placeholder="YYYY/MM/DD HH:MM" class="form-control collection-input-width"
                                            value="{{ old('expected_delivetr_dttm') }}" />
                                        @error('expected_delivetr_dttm')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row m-left-20" id="collection_details_div" style="display: none;">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="date_of_collection" class="control-label">
                                            Date of collection :
                                        </label>
                                        <input type="text" name="date_of_collection" id="date_of_collection"
                                            placeholder="YYYY/MM/DD HH:MM" class="form-control collection-input-width"
                                            value="{{ old('date_of_collection') }}" />
                                        @error('date_of_collection')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="location_of_collection" class="control-label">
                                            Central Location of collection :
                                        </label>
                                        <input type="text" name="location_of_collection" id="location_of_collection"
                                            placeholder="Central Location of collection"
                                            class="form-control collection-input-width"
                                            value="{{ old('location_of_collection') }}" />
                                        @error('location_of_collection')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="collection_contact_person" class="control-label">
                                            Contact person name :
                                        </label>
                                        <input type="text" name="collection_contact_person"
                                            id="collection_contact_person" placeholder="Central Location of collection"
                                            class="form-control collection-input-width"
                                            value="{{ old('collection_contact_person') }}" />
                                        @error('collection_contact_person')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="collection_contact_number" class="control-label">
                                            Contact person number :
                                        </label>
                                        <input type="text" name="collection_contact_number"
                                            id="collection_contact_number" placeholder="Central Location of collection"
                                            class="form-control collection-input-width"
                                            value="{{ old('collection_contact_number') }}" />
                                        @error('collection_contact_number')
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
                                        {{-- <select class="form-control input-width" name="venues_distribution"
                                            id="venues_distribution">
                                            <option value="">-- Select --</option>
                                            <option @if (old('venues_distribution') == 'Yes') selected @endif value="Yes">Yes
                                            </option>
                                            <option @if (old('venues_distribution') == 'No') selected @endif value="No">No
                                            </option>
                                        </select> --}}

                                        <br>
                                        <input type="radio" @if (old('venues_distribution') == 'Yes') checked @endif
                                            id="venues_distribution_yes" name="venues_distribution" value="Yes">
                                        <label for="venues_distribution_yes">Yes</label><br>
                                        <input type="radio" @if (old('venues_distribution') == 'No') checked @endif
                                            id="venues_distribution_no" name="venues_distribution" value="No">
                                        <label for="venues_distribution_no">No</label><br>
                                        <label id="venues_distribution-error" class="error"
                                            for="venues_distribution"></label>
                                        @error('venues_distribution')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row m-left-20" id="venue_details_div" style="display: none;">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="venues_distribution_date" class="control-label">
                                            Date :
                                        </label>
                                        <input type="text" name="venues_distribution_date"
                                            id="venues_distribution_date" placeholder="YYYY/MM/DD HH:MM"
                                            class="form-control collection-input-width"
                                            value="{{ old('venues_distribution_date') }}" />
                                        @error('venues_distribution_date')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="venues_distribution_place" class="control-label">
                                            Venue :
                                        </label>
                                        <input type="text" name="venues_distribution_place"
                                            id="venues_distribution_place" placeholder="Central Location of collection"
                                            class="form-control collection-input-width"
                                            value="{{ old('venues_distribution_place') }}" />
                                        @error('venues_distribution_place')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="venues_distribution_contact" class="control-label">
                                            Contact person name :
                                        </label>
                                        <input type="text" name="venues_distribution_contact"
                                            id="venues_distribution_contact" placeholder="Central Location of collection"
                                            class="form-control collection-input-width"
                                            value="{{ old('venues_distribution_contact') }}" />
                                        @error('venues_distribution_contact')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="venues_distribution_contact_number" class="control-label">
                                            Contact person number :
                                        </label>
                                        <input type="text" name="venues_distribution_contact_number"
                                            id="venues_distribution_contact_number"
                                            placeholder="Central Location of collection"
                                            class="form-control collection-input-width"
                                            value="{{ old('venues_distribution_contact_number') }}" />
                                        @error('venues_distribution_contact_number')
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
                            <div class="row m-left-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description_of_materials" class="control-label">
                                            Description of Materials :
                                        </label>
                                        <input type="text" name="transport_description_of_materials"
                                            id="transport_description_of_materials"
                                            placeholder="E.g.: Brown Foldable Plastic Tables 1.5x.3m"
                                            class="form-control input-width"
                                            value="{{ old('transport_description_of_materials') }}" />
                                        @error('transport_description_of_materials')
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
                                        <select class="form-control input-width"
                                            name="transport_goods_preparation_type_id"
                                            id="transport_goods_preparation_type_id">
                                            <option value="">Select Goods Preparation Type</option>
                                            @foreach ($goods_preparation_types as $goodsPreparationTypes)
                                                <option @if (old('transport_goods_preparation_type_id') == $goodsPreparationTypes->id) selected @endif
                                                    value="{{ $goodsPreparationTypes->id }}">
                                                    {{ $goodsPreparationTypes->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('transport_goods_preparation_type_id')
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
                                        <input type="number" min="1" name="transport_no_of_packaged_goods"
                                            id="transport_no_of_packaged_goods" placeholder="e.g.: 200"
                                            class="form-control input-width"
                                            value="{{ old('transport_no_of_packaged_goods') }}" />
                                        @error('transport_no_of_packaged_goods')
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
                                        <input type="text" name="transport_packaging_specifications"
                                            id="transport_packaging_specifications"
                                            placeholder="Please specify if the dimensions are per unit/box/pallet"
                                            class="form-control input-width"
                                            value="{{ old('transport_packaging_specifications') }}" />
                                        @error('transport_packaging_specifications')
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
                                        <input type="text" name="transport_weight_of_goods"
                                            id="transport_weight_of_goods"
                                            placeholder="Please specify if the weight is per unit/box/pallet or total"
                                            class="form-control input-width"
                                            value="{{ old('transport_weight_of_goods') }}" />
                                        @error('transport_weight_of_goods')
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
                                        <label for="collection_dttm" class="control-label">
                                            Collection Date and Time :
                                        </label>
                                        <input type="text" name="transport_collection_dttm"
                                            id="transport_collection_dttm" placeholder="YYYY/MM/DD HH:MM"
                                            class="form-control input-width"
                                            value="{{ old('transport_collection_dttm') }}" />
                                        @error('transport_collection_dttm')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="collection_location" class="control-label">
                                            Collection Location :
                                        </label>
                                        <input type="text" name="transport_collection_location"
                                            id="transport_collection_location" placeholder="Collection Location"
                                            class="form-control input-width"
                                            value="{{ old('transport_collection_location') }}" />
                                        @error('transport_collection_location')
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
                                        <label for="collection_contact_name" class="control-label">
                                            Collection Contact Name :
                                        </label>
                                        <input type="text" name="transport_collection_contact_name"
                                            id="transport_collection_contact_name" placeholder="Collection Contact Name"
                                            class="form-control input-width"
                                            value="{{ old('transport_collection_contact_name') }}" />
                                        @error('transport_collection_contact_name')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="collection_contact_number" class="control-label">
                                            Collection Contact Number :
                                        </label>
                                        <input type="text" name="transport_collection_contact_number"
                                            id="transport_collection_contact_number"
                                            placeholder="Collection Contact Number" class="form-control input-width"
                                            value="{{ old('transport_collection_contact_number') }}" />
                                        @error('transport_collection_contact_number')
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
                                        <label for="delivery_dttm" class="control-label">
                                            Delivery Date and Time :
                                        </label>
                                        <input type="text" name="transport_delivery_dttm" id="transport_delivery_dttm"
                                            placeholder="YYYY/MM/DD HH:MM" class="form-control input-width"
                                            value="{{ old('transport_delivery_dttm') }}" />
                                        @error('transport_delivery_dttm')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="delivery_location" class="control-label">
                                            Delivery Location :
                                        </label>
                                        <input type="text" name="transport_delivery_location"
                                            id="transport_delivery_location" placeholder="Delivery Location"
                                            class="form-control input-width"
                                            value="{{ old('transport_delivery_location') }}" />
                                        @error('transport_delivery_location')
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
                                        <label for="delivery_contact_name" class="control-label">
                                            Delivery Contact Name :
                                        </label>
                                        <input type="text" name="transport_delivery_contact_name"
                                            id="transport_delivery_contact_name" placeholder="Delivery Contact Name"
                                            class="form-control input-width"
                                            value="{{ old('transport_delivery_contact_name') }}" />
                                        @error('transport_delivery_contact_name')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="delivery_contact_number" class="control-label">
                                            Delivery Contact Number :
                                        </label>
                                        <input type="text" name="transport_delivery_contact_number"
                                            id="transport_delivery_contact_number" placeholder="Delivery Contact Number"
                                            class="form-control input-width"
                                            value="{{ old('transport_delivery_contact_number') }}" />
                                        @error('transport_delivery_contact_number')
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
                                        {{-- <select class="form-control input-width" name="transport_any_dangerous"
                                            id="transport_any_dangerous">
                                            <option value="">-- Select --</option>
                                            <option @if (old('transport_any_dangerous') == 'Yes') selected @endif value="Yes">Yes
                                            </option>
                                            <option @if (old('transport_any_dangerous') == 'No') selected @endif value="No">No
                                            </option>
                                        </select> --}}
                                        <br>
                                        <input type="radio" @if (old('transport_any_dangerous') == 'Yes') checked @endif
                                            id="transport_any_dangerous_yes" name="transport_any_dangerous"
                                            value="Yes">
                                        <label for="transport_any_dangerous_yes">Yes</label><br>
                                        <input type="radio" @if (old('transport_any_dangerous') == 'No') checked @endif
                                            id="transport_any_dangerous_no" name="transport_any_dangerous"
                                            value="No">
                                        <label for="transport_any_dangerous_no">No</label><br>
                                        <label id="transport_any_dangerous-error" class="error" for="transport_any_dangerous"></label>
                                        @error('transport_any_dangerous')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6" id="transport_dangerous_details_div" style="display: none;">
                                    <div class="form-group">
                                        <label for="dangerous_details" class="control-label">
                                            If YES, Please specify :
                                        </label>
                                        <input type="text" name="transport_dangerous_details"
                                            id="transport_dangerous_details" placeholder="If YES, Please specify"
                                            class="form-control input-width"
                                            value="{{ old('transport_dangerous_details') }}" />
                                        @error('transport_dangerous_details')
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
                                        {{-- <select class="form-control input-width"
                                            name="transport_special_handling_requirements"
                                            id="transport_special_handling_requirements">
                                            <option value="">-- Select --</option>
                                            <option @if (old('transport_special_handling_requirements') == 'Yes') selected @endif value="Yes">Yes
                                            </option>
                                            <option @if (old('transport_special_handling_requirements') == 'No') selected @endif value="No">No
                                            </option>
                                        </select> --}}
                                        <br>
                                        <input type="radio" @if (old('transport_special_handling_requirements') == 'Yes') checked @endif
                                            id="transport_special_handling_requirements_yes"
                                            name="transport_special_handling_requirements" value="Yes">
                                        <label for="transport_special_handling_requirements_yes">Yes</label><br>
                                        <input type="radio" @if (old('transport_special_handling_requirements') == 'No') checked @endif
                                            id="transport_special_handling_requirements_no"
                                            name="transport_special_handling_requirements" value="No">
                                        <label for="transport_special_handling_requirements_no">No</label><br>
                                        <label id="transport_special_handling_requirements-error" class="error" for="transport_special_handling_requirements"></label>
                                        @error('transport_special_handling_requirements')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6" id="transport_special_handling_details_div" style="display: none;">
                                    <div class="form-group">
                                        <label for="special_handling_details" class="control-label">
                                            If YES, Please specify :
                                        </label>
                                        <input type="text" name="transport_special_handling_details"
                                            id="transport_special_handling_details" placeholder="If YES, Please specify"
                                            class="form-control input-width"
                                            value="{{ old('transport_special_handling_details') }}" />
                                        @error('transport_special_handling_details')
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
        <div class="container" id="on_venue_assistance" style="padding:5px 0px;display:none;">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            On-Venue Assistance* (Crew, MHE, Other Venue Support)
                        </div>
                        <div class="panel-body" style="padding: 0px 25px;">
                            <p style="color:#94042C;">*Please note that Logistics team</p>
                            <p style="color:#94042C;">- Only collects items from a central location</p>
                            <p style="color:#94042C;">- Only delivers to a central location</p>
                            <p style="color:#94042C;">- Does not unpack and re-distribute individual items</p>
                            <div class="row m-left20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="crew_assistance" class="control-label">
                                            Do you require CREW assistance? :
                                        </label>
                                        {{-- <select class="form-control input-width" name="crew_assistance"
                                            id="crew_assistance">
                                            <option value="">-- Select --</option>
                                            <option @if (old('crew_assistance') == 'Yes') selected @endif value="Yes">Yes
                                            </option>
                                            <option @if (old('crew_assistance') == 'No') selected @endif value="No">No
                                            </option>
                                        </select> --}}
                                        <br>
                                        <input type="radio" @if (old('crew_assistance') == 'Yes') checked @endif
                                            id="crew_assistance_yes" name="crew_assistance" value="Yes">
                                        <label for="crew_assistance_yes">Yes</label><br>
                                        <input type="radio" @if (old('crew_assistance') == 'No') checked @endif
                                            id="crew_assistance_no" name="crew_assistance" value="No">
                                        <label for="crew_assistance_no">No</label>
                                        <br>
                                        <label id="crew_assistance-error" class="error" for="crew_assistance"></label>
                                        @error('crew_assistance')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div id="crew_assistance_div" style="display: none;">
                                <div class="row m-left20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="crew_quantity" class="control-label">
                                                If YES, specify Number of crew required
                                            </label>
                                            <input type="hidden" class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-left20">
                                    <div class="col-md-3" style="margin-right: 50px;">
                                        <div class="form-group">
                                            <label for="crew_quantity" class="control-label">
                                                Crew :
                                            </label>
                                            <input type="number" min="1" name="crew_quantity" id="crew_quantity"
                                                placeholder="Crew Quantity" class="form-control "
                                                value="{{ old('crew_quantity') }}" />
                                            @error('crew_quantity')
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="supervisor_quantity" class="control-label">
                                                Supervisor :
                                            </label>
                                            <input type="number" min="1" name="supervisor_quantity"
                                                id="supervisor_quantity" placeholder="Supervisor Quantity"
                                                class="form-control " value="{{ old('supervisor_quantity') }}" />
                                            @error('supervisor_quantity')
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-left20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="material_handling_equipment" class="control-label">
                                            Do you require MHE (Material Handling Equipment)? :
                                        </label>
                                        {{-- <select class="form-control input-width" name="material_handling_equipment"
                                            id="material_handling_equipment">
                                            <option value="">-- Select --</option>
                                            <option @if (old('material_handling_equipment') == 'Yes') selected @endif value="Yes">Yes
                                            </option>
                                            <option @if (old('material_handling_equipment') == 'No') selected @endif value="No">No
                                            </option>
                                        </select> --}}
                                        <br>
                                        <input type="radio" @if (old('material_handling_equipment') == 'Yes') checked @endif
                                            id="material_handling_equipment_yes" name="material_handling_equipment"
                                            value="Yes">
                                        <label for="material_handling_equipment_yes">Yes</label><br>
                                        <input type="radio" @if (old('material_handling_equipment') == 'No') checked @endif
                                            id="material_handling_equipment_no" name="material_handling_equipment"
                                            value="No">
                                        <label for="material_handling_equipment_no">No</label>
                                        <br>
                                        <label id="material_handling_equipment-error" class="error" for="material_handling_equipment"></label>
                                        @error('material_handling_equipment')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div id="material_handling_equipment_div" style="display: none;">
                                <div class="row m-left20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="crew_quantity" class="control-label">
                                                If YES, specify what MHE and quantity of MHE required
                                            </label>
                                            <input type="hidden" class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-left20">
                                    <div class="col-md-3" style="margin-right: 50px;">
                                        <div class="form-group">
                                            <label for="forklift_quantity" class="control-label">
                                                Forklift :
                                            </label>
                                            <input type="number" min="1" name="forklift_quantity"
                                                id="forklift_quantity" placeholder="Forklift Quantity"
                                                class="form-control " value="{{ old('forklift_quantity') }}" />
                                            @error('forklift_quantity')
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3" style="margin-right: 50px;">
                                        <div class="form-group">
                                            <label for="pallet_jack_quantity" class="control-label">
                                                Pallet Jack :
                                            </label>
                                            <input type="number" min="1" name="pallet_jack_quantity"
                                                id="pallet_jack_quantity" placeholder="Pallet Jack Quantity"
                                                class="form-control " value="{{ old('pallet_jack_quantity') }}" />
                                            @error('pallet_jack_quantity')
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="trolley_quantity" class="control-label">
                                                Trolley :
                                            </label>
                                            <input type="number" min="1" name="trolley_quantity"
                                                id="trolley_quantity" placeholder="Trolley Quantity"
                                                class="form-control " value="{{ old('trolley_quantity') }}" />
                                            @error('trolley_quantity')
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-left20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="logistics_assistance_venue" class="control-label">
                                            Do you require other Logistics assistance on Venue :
                                        </label>
                                        {{-- <select class="form-control input-width" name="logistics_assistance_venue"
                                            id="logistics_assistance_venue">
                                            <option value="">-- Select --</option>
                                            <option @if (old('logistics_assistance_venue') == 'Yes') selected @endif value="Yes">Yes
                                            </option>
                                            <option @if (old('logistics_assistance_venue') == 'No') selected @endif value="No">No
                                            </option>
                                        </select> --}}
                                        <br>
                                        <input type="radio" @if (old('logistics_assistance_venue') == 'Yes') checked @endif
                                            id="logistics_assistance_venue_yes" name="logistics_assistance_venue"
                                            value="Yes">
                                        <label for="logistics_assistance_venue_yes">Yes</label><br>
                                        <input type="radio" @if (old('logistics_assistance_venue') == 'No') checked @endif
                                            id="logistics_assistance_venue_no" name="logistics_assistance_venue"
                                            value="No">
                                        <label for="logistics_assistance_venue_no">No</label>
                                        <br>
                                        <label id="logistics_assistance_venue-error" class="error" for="logistics_assistance_venue"></label>
                                        @error('logistics_assistance_venue')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6" id="logistics_assistance_venue_div" style="display: none;">
                                    <div class="form-group">
                                        <label for="logistics_assistance_venue_details" class="control-label">
                                            If yes, please specify
                                        </label>
                                        <input type="text" name="logistics_assistance_venue_details"
                                            id="logistics_assistance_venue_details" placeholder="If yes, please specify"
                                            class="form-control input-width"
                                            value="{{ old('logistics_assistance_venue_details') }}" />
                                        @error('logistics_assistance_venue_details')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row m-left20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="short_breif_activity" class="control-label">
                                            Provide a short brief of the activity :
                                        </label>
                                        <input type="text" name="short_breif_activity" id="short_breif_activity"
                                            placeholder="Provide a short brief of the activity"
                                            class="form-control input-width"
                                            value="{{ old('short_breif_activity') }}" />
                                        @error('short_breif_activity')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row m-left20">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="location" class="control-label">
                                            Location :
                                        </label>
                                        <input type="text" name="location" id="location" placeholder="Location"
                                            class="form-control" value="{{ old('location') }}" style="width: 250px;" />
                                        @error('location')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ova_contact_name" class="control-label">
                                            Contact Name :
                                        </label>
                                        <input type="text" name="ova_contact_name" id="ova_contact_name"
                                            placeholder="Contact Name" class="form-control "
                                            value="{{ old('ova_contact_name') }}" style="width: 250px;" />
                                        @error('ova_contact_name')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_number" class="control-label">
                                            Contact Number :
                                        </label>
                                        <input type="text" name="ova_contact_number" id="ova_contact_number"
                                            placeholder="Contact Number" class="form-control "
                                            value="{{ old('ova_contact_number') }}" style="width: 250px;" />
                                        @error('ova_contact_number')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row m-left20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date" class="control-label">
                                            Start Date :
                                        </label>
                                        <input type="text" name="start_date" id="start_date" placeholder="Start Date"
                                            class="form-control input-width" value="{{ old('start_date') }}" />
                                        @error('start_date')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_time" class="control-label">
                                            Start Time :
                                        </label>
                                        <input type="text" name="start_time" id="start_time" placeholder="Start Date"
                                            class="form-control input-width" value="{{ old('start_time') }}" />
                                        @error('start_time')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row m-left20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date" class="control-label">
                                            End Date :
                                        </label>
                                        <input type="text" name="end_date" id="end_date" placeholder="End Date"
                                            class="form-control input-width" value="{{ old('end_date') }}" />
                                        @error('end_date')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_time" class="control-label">
                                            End Time :
                                        </label>
                                        <input type="text" name="end_time" id="end_time" placeholder="End Date"
                                            class="form-control input-width" value="{{ old('end_time') }}" />
                                        @error('end_time')
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

        <div class="form-group">
            <label for="submit" class="col-md-6 control-label"></label>
            <div class="col-md-4">
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
    @push('scripts')
        <script>
            $(document).ready(function() {
                var service = "{!! old('service') !!}"
                if (service == '1') {
                    $("#warehouse_storage_space").show();
                    $("#transportation_goods_to_venues").hide();
                    $("#on_venue_assistance").hide();

                    var any_dangerous = "{!! old('any_dangerous') !!}"
                    if (any_dangerous == 'Yes') {
                        $("#dangerous_details_div").show();
                    } else {
                        $("#dangerous_details_div").hide();
                    }

                    var dissolution_plan_place = "{!! old('dissolution_plan_place') !!}"
                    if (dissolution_plan_place == 'Yes') {
                        $("#dissolution_plan_details_div").show();
                    } else {
                        $("#dissolution_plan_details_div").hide();
                    }

                    var special_handling_requirements = "{!! old('special_handling_requirements') !!}"
                    if (special_handling_requirements == 'Yes') {
                        $("#special_handling_details_div").show();
                    } else {
                        $("#special_handling_details_div").hide();
                    }

                    var transport_to_deliver = "{!! old('transport_to_deliver') !!}"
                    if (transport_to_deliver == 'Yes') {
                        $("#transport_to_deliver_details_div").show();
                        $("#collection_details_div").hide();
                    } else if (transport_to_deliver == 'No') {
                        $("#transport_to_deliver_details_div").hide();
                        $("#collection_details_div").show();
                    } else {
                        $("#transport_to_deliver_details_div").hide();
                        $("#collection_details_div").hide();
                    }

                    var venues_distribution = "{!! old('venues_distribution') !!}"
                    if (venues_distribution == 'Yes') {
                        $("#venue_details_div").show();
                    } else {
                        $("#venue_details_div").hide();
                    }
                } else if (service == '2') {
                    $("#warehouse_storage_space").hide();
                    $("#transportation_goods_to_venues").show();
                    $("#on_venue_assistance").hide();

                    var transport_any_dangerous = "{!! old('transport_any_dangerous') !!}"
                    if (transport_any_dangerous == 'Yes') {
                        $("#transport_dangerous_details_div").show();
                    } else {
                        $("#transport_dangerous_details_div").hide();
                    }

                    var transport_special_handling_requirements = "{!! old('transport_special_handling_requirements') !!}"
                    if (transport_special_handling_requirements == 'Yes') {
                        $("#transport_special_handling_details_div").show();
                    } else {
                        $("#transport_special_handling_details_div").hide();
                    }

                } else if (service == '3') {

                    $("#warehouse_storage_space").hide();
                    $("#transportation_goods_to_venues").hide();
                    $("#on_venue_assistance").show();

                    var crew_assistance = "{!! old('crew_assistance') !!}"
                    if (crew_assistance == 'Yes') {
                        $("#crew_assistance_div").show();
                    } else {
                        $("#crew_assistance_div").hide();
                    }

                    var material_handling_equipment = "{!! old('material_handling_equipment') !!}"
                    if (material_handling_equipment == 'Yes') {
                        $("#material_handling_equipment_div").show();
                    } else {
                        $("#material_handling_equipment_div").hide();
                    }

                    var logistics_assistance_venue = "{!! old('logistics_assistance_venue') !!}"
                    if (logistics_assistance_venue == 'Yes') {
                        $("#logistics_assistance_venue_div").show();
                    } else {
                        $("#logistics_assistance_venue_div").hide();
                    }

                } else {
                    $("#warehouse_storage_space").hide();
                    $("#transportation_goods_to_venues").hide();
                    $("#on_venue_assistance").hide();
                }
            });
        </script>
        <script>
            $(function() {
                $('#storage_start_date').datetimepicker({
                    format: 'Y-MM-DD',
                });
                $('#storage_end_date').datetimepicker({
                    format: 'Y-MM-DD',

                });
                $('#expected_delivetr_dttm').datetimepicker({
                    format: 'Y-MM-DD hh:mm',
                });
                $('#date_of_collection').datetimepicker({
                    format: 'Y-MM-DD hh:mm',
                });
                $('#venues_distribution_date').datetimepicker({
                    format: 'Y-MM-DD hh:mm',
                });

                $('#transport_collection_dttm').datetimepicker({
                    format: 'Y-MM-DD hh:mm',
                });

                $('#transport_delivery_dttm').datetimepicker({
                    format: 'Y-MM-DD hh:mm',
                });

                $('#start_date').datetimepicker({
                    format: 'Y-MM-DD',
                });

                $('#end_date').datetimepicker({
                    format: 'Y-MM-DD',
                });

                $('#start_time').datetimepicker({
                    format: 'hh:mm A'
                });

                $('#end_time').datetimepicker({
                    format: 'hh:mm A'
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
            // $('#any_dangerous').on('change', function() {
            $('input[type=radio][name=any_dangerous]').change(function() {
                if (this.value == 'Yes') {
                    $("#dangerous_details_div").show();
                } else {
                    $("#dangerous_details_div").hide();
                }
            });
            // $('#dissolution_plan_place').on('change', function() {
            $('input[type=radio][name=dissolution_plan_place]').change(function() {
                if (this.value == 'Yes') {
                    $("#dissolution_plan_details_div").show();
                } else {
                    $("#dissolution_plan_details_div").hide();
                }
            });
            // $('#special_handling_requirements').on('change', function() {
            $('input[type=radio][name=special_handling_requirements]').change(function() {
                if (this.value == 'Yes') {
                    $("#special_handling_details_div").show();
                } else {
                    $("#special_handling_details_div").hide();
                }
            });
            // $('#transport_to_deliver').on('change', function() {
            $('input[type=radio][name=transport_to_deliver]').change(function() {
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

            // $('#venues_distribution').on('change', function() {
            $('input[type=radio][name=venues_distribution]').change(function() {
                if (this.value == 'Yes') {
                    $("#venue_details_div").show();
                } else {
                    $("#venue_details_div").hide();
                }
            });

            // $('#transport_any_dangerous').on('change', function() {
            $('input[type=radio][name=transport_any_dangerous]').change(function() {
                if (this.value == 'Yes') {
                    $("#transport_dangerous_details_div").show();
                } else {
                    $("#transport_dangerous_details_div").hide();
                }
            });

            // $('#transport_special_handling_requirements').on('change', function() {
            $('input[type=radio][name=transport_special_handling_requirements]').change(function() {
                if (this.value == 'Yes') {
                    $("#transport_special_handling_details_div").show();
                } else {
                    $("#transport_special_handling_details_div").hide();
                }
            });

            // $('#crew_assistance').on('change', function() {
            $('input[type=radio][name=crew_assistance]').change(function() {
                if (this.value == 'Yes') {
                    $("#crew_assistance_div").show();

                } else {
                    $("#crew_assistance_div").hide();
                }
            });
            // $('#material_handling_equipment').on('change', function() {
            $('input[type=radio][name=material_handling_equipment]').change(function() {
                if (this.value == 'Yes') {
                    $("#material_handling_equipment_div").show();

                } else {
                    $("#material_handling_equipment_div").hide();
                }
            });
            // $('#logistics_assistance_venue').on('change', function() {
            $('input[type=radio][name=logistics_assistance_venue]').change(function() {
                if (this.value == 'Yes') {
                    $("#logistics_assistance_venue_div").show();

                } else {
                    $("#logistics_assistance_venue_div").hide();
                }
            });
        </script>
        <script>
            $().ready(function() {
                $("#mobile").keypress(function(e) {
                    var charCode = (e.which) ? e.which : e.keyCode;
                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                        return false;
                    }
                });
                $("#collection_contact_number").keypress(function(e) {
                    var charCode = (e.which) ? e.which : e.keyCode;
                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                        return false;
                    }
                });
                $("#venues_distribution_contact_number").keypress(function(e) {
                    var charCode = (e.which) ? e.which : e.keyCode;
                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                        return false;
                    }
                });
                $("#transport_collection_contact_number").keypress(function(e) {
                    var charCode = (e.which) ? e.which : e.keyCode;
                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                        return false;
                    }
                });
                $("#transport_delivery_contact_number").keypress(function(e) {
                    var charCode = (e.which) ? e.which : e.keyCode;
                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                        return false;
                    }
                });
                jQuery.validator.addMethod("emailExt", function(value, element, param) {
                    return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
                }, "Please enter valid email format");

                jQuery.validator.addMethod("futuredate", function(value, element) {
                    var now = new Date();
                    var myDate = new Date(value);
                    return this.optional(element) || myDate > now;

                }, "Please select date and time from today");

                jQuery.validator.addMethod("greaterThan",
                    function(value, element, params) {

                        if (!/Invalid|NaN/.test(new Date(value))) {
                            return new Date(value) > new Date($(params).val());
                        }

                        return isNaN(value) && isNaN($(params).val()) ||
                            (Number(value) > Number($(params).val()));
                    }, 'Must be greater than start date.');

                $.validator.addMethod('numericOnly', function(value) {
                    return /^[0-9]+$/.test(value);
                }, "Only number is allowed.");

                $('#applicationForm').validate({
                    rules: {
                        name: {
                            required: true
                        },
                        email: {
                            required: true,
                            emailExt: true
                        },
                        mobile: {
                            required: true,
                            numericOnly: true
                        },
                        project_functional_area: {
                            required: true,
                        },
                        job_title: {
                            required: true,
                        },
                        service: {
                            required: true,
                        },
                        description_of_materials: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]').val() == 1;
                                }
                            }
                        },
                        storage_type_id: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1;
                                }
                            }
                        },
                        quantity_of_items: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1;
                                }
                            }
                        },
                        goods_preparation_type_id: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1;
                                }
                            }
                        },
                        no_of_packaged_goods: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1;
                                }
                            }
                        },
                        packaging_specifications: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1;
                                }
                            }
                        },
                        weight_of_goods: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1;
                                }
                            }
                        },
                        storage_start_date: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1;
                                }
                            },
                            futuredate: true
                        },
                        storage_end_date: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1;
                                }
                            },
                            futuredate: true,
                            greaterThan: "#storage_start_date"
                        },
                        any_dangerous: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1;
                                }
                            },
                        },
                        dangerous_details: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1 && $(
                                        'input:radio[name="any_dangerous"]').val() == 'Yes';
                                }
                            },
                        },
                        dissolution_plan_place: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1;
                                }
                            },
                        },
                        dissolution_plan_details: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1 && $(
                                        'input:radio[name="dissolution_plan_place"]').val() == 'Yes';
                                }
                            },
                        },
                        special_handling_requirements: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1;
                                }
                            },
                        },
                        special_handling_details: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1 && $(
                                            'input:radio[name="special_handling_requirements"]').val() ==
                                        'Yes';
                                }
                            },
                        },
                        transport_to_deliver: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1;
                                }
                            },
                        },
                        expected_delivetr_dttm: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1 && $(
                                        'input:radio[name="transport_to_deliver"]').val() == 'Yes';
                                }
                            },
                            futuredate: true,
                        },
                        date_of_collection: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1 && $(
                                        'input:radio[name="transport_to_deliver"]').val() == 'No';
                                }
                            },
                            futuredate: true,
                        },
                        location_of_collection: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1 && $(
                                        'input:radio[name="transport_to_deliver"]').val() == 'No';
                                }
                            },
                        },
                        collection_contact_person: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1 && $(
                                        'input:radio[name="transport_to_deliver"]').val() == 'No';
                                }
                            },
                        },
                        collection_contact_number: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1 && $(
                                        'input:radio[name="transport_to_deliver"]').val() == 'No';
                                }
                            },
                        },
                        venues_distribution: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1;
                                }
                            },
                        },
                        venues_distribution_date: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1 && $(
                                        'input:radio[name="transport_to_deliver"]').val() == 'Yes';
                                }
                            },
                            futuredate: true,
                        },
                        venues_distribution_place: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1 && $(
                                        'input:radio[name="transport_to_deliver"]').val() == 'Yes';
                                }
                            },
                        },
                        venues_distribution_contact: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1 && $(
                                        'input:radio[name="transport_to_deliver"]').val() == 'Yes';
                                }
                            },
                        },
                        venues_distribution_contact_number: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 1 && $(
                                        'input:radio[name="transport_to_deliver"]').val() == 'Yes';
                                }
                            },
                        },
                        transport_description_of_materials: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 2;
                                }
                            }
                        },
                        transport_goods_preparation_type_id: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 2;
                                }
                            }
                        },
                        transport_no_of_packaged_goods: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 2;
                                }
                            }
                        },
                        transport_packaging_specifications: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 2;
                                }
                            }
                        },
                        transport_weight_of_goods: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 2;
                                }
                            }
                        },
                        transport_collection_dttm: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 2;
                                }
                            },
                            futuredate: true,
                        },
                        transport_collection_location: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 2;
                                }
                            },
                        },
                        transport_collection_contact_name: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 2;
                                }
                            },
                        },
                        transport_collection_contact_number: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 2;
                                }
                            },
                        },
                        transport_delivery_dttm: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 2;
                                }
                            },
                            futuredate: true,
                        },
                        transport_delivery_location: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 2;
                                }
                            },
                        },
                        transport_delivery_contact_name: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 2;
                                }
                            },
                        },
                        transport_delivery_contact_number: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 2;
                                }
                            },
                        },
                        transport_any_dangerous: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 2;
                                }
                            },
                        },
                        transport_dangerous_details: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 2 && $(
                                        'input:radio[name="transport_any_dangerous"]').val() == 'Yes';
                                }
                            },
                        },
                        transport_special_handling_requirements: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 2;
                                }
                            },
                        },
                        transport_special_handling_details: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 2 && $(
                                        'input:radio[name="transport_special_handling_requirements"]').val() == 'Yes';
                                }
                            },
                        },
                        crew_assistance: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 3;
                                }
                            },
                        },
                        crew_quantity: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 3 && $(
                                        'input:radio[name="crew_assistance"]').val() == 'Yes';
                                }
                            },
                        },
                        supervisor_quantity: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 3 && $(
                                        'input:radio[name="crew_assistance"]').val() == 'Yes';
                                }
                            },
                        },
                        material_handling_equipment: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 3;
                                }
                            },
                        },
                        forklift_quantity: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 3 && $(
                                        'input:radio[name="material_handling_equipment"]').val() == 'Yes';
                                }
                            },
                        },
                        pallet_jack_quantity: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 3 && $(
                                        'input:radio[name="material_handling_equipment"]').val() == 'Yes';
                                }
                            },
                        },
                        trolley_quantity: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 3 && $(
                                        'input:radio[name="material_handling_equipment"]').val() == 'Yes';
                                }
                            },
                        },
                        logistics_assistance_venue: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 3;
                                }
                            },
                        },
                        logistics_assistance_venue_details: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 3 && $(
                                        'input:radio[name="logistics_assistance_venue"]').val() == 'Yes';
                                }
                            },
                        },
                        short_breif_activity: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 3;
                                }
                            },
                        },
                        location: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 3;
                                }
                            },
                        },
                        ova_contact_name: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 3;
                                }
                            },
                        },
                        start_date: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 3;
                                }
                            },
                            futuredate :  true
                        },
                        end_date: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 3;
                                }
                            },
                            futuredate :  true,
                            greaterThan: "#start_date"
                        },
                        start_time: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 3;
                                }
                            },
                        },
                        end_time: {
                            required: {
                                depends: function(element) {
                                    return $('input:radio[name="service"]:checked').val() == 3;
                                }
                            },
                        },
                    },
                    messages: {
                        name: {
                            required: "Please enter name"
                        },
                        email: {
                            required: "Please enter email",
                        },
                        mobile: {
                            required: "Please enter mobile number",
                        },
                        project_functional_area: {
                            required: 'Please enter project functional area'
                        },
                        job_title: {
                            required: 'Please enter job title'
                        },
                        service: {
                            required: "Please select any service"
                        },
                        description_of_materials: {
                            required: "Please enter materials description"
                        },
                        storage_type_id: {
                            required: "Please select storage types"
                        },
                        quantity_of_items: {
                            required: "Please enter quantity"
                        },
                        goods_preparation_type_id: {
                            required: "Please selectgoods preparation type"
                        },
                        no_of_packaged_goods: {
                            required: "Please enter number of goods"
                        },
                        packaging_specifications: {
                            required: "Please enter pakage specifications"
                        },
                        weight_of_goods: {
                            required: "Please enter goods weight"
                        },
                        storage_start_date: {
                            required: "Please enter storage start date"
                        },
                        storage_end_date: {
                            required: "Please enter storage end date"
                        },
                        any_dangerous: {
                            required: "Please choose any dangerous"
                        },
                        dangerous_details: {
                            required: "Please enter dangerous details"
                        },
                        dissolution_plan_place: {
                            required: "Please choose dissolution plan place"
                        },
                        dissolution_plan_details: {
                            required: "Please enter dissolution plan details"
                        },
                        special_handling_requirements: {
                            required: "Please choose special handling requirements"
                        },
                        special_handling_details: {
                            required: "Please enter special handling details"
                        },
                        transport_to_deliver: {
                            required: "Please choose transport to deliver"
                        },
                        expected_delivetr_dttm: {
                            required: "Please enter expected delivery date & time"
                        },
                        date_of_collection: {
                            required: "Please enter date of collection"
                        },
                        location_of_collection: {
                            required: "Please enter collection location"
                        },
                        collection_contact_person: {
                            required: "Please enter collection contact person"
                        },
                        collection_contact_number: {
                            required: "Please enter collection contact number"
                        },
                        venues_distribution: {
                            required: "Please choose venues distribution"
                        },
                        venues_distribution_date: {
                            required: "Please enter venues distribution date & time"
                        },
                        venues_distribution_place: {
                            required: "Please enter venues distribution place"
                        },
                        venues_distribution_contact: {
                            required: "Please enter contact person name"
                        },
                        venues_distribution_contact_number: {
                            required: "Please enter contact persion number"
                        },
                        transport_description_of_materials: {
                            required: "Please enter description of materials"
                        },
                        transport_goods_preparation_type_id: {
                            required: "Please select goods preparation type"
                        },
                        transport_no_of_packaged_goods: {
                            required: "Please enter number of packaged goods"
                        },
                        transport_packaging_specifications: {
                            required: "Please enter packaging specifications"
                        },
                        transport_weight_of_goods: {
                            required: "Please enter weight of goods"
                        },
                        transport_collection_dttm: {
                            required: "Please enter collection date and time"
                        },
                        transport_collection_location: {
                            required: "Please enter collection location"
                        },
                        transport_collection_contact_name: {
                            required: "Please enter collection contact name"
                        },
                        transport_collection_contact_number: {
                            required: "Please enter collection contact number"
                        },
                        transport_delivery_dttm: {
                            required: "Please enter delivery date and time"
                        },
                        transport_delivery_location: {
                            required: "Please enter delivery location"
                        },
                        transport_delivery_contact_name: {
                            required: "Please enter delivery contact name"
                        },
                        transport_delivery_contact_number: {
                            required: "Please enter delivery contact number"
                        },
                        transport_any_dangerous: {
                            required: "Please choose any dangerous"
                        },
                        transport_dangerous_details: {
                            required: "Please enter dangerous details"
                        },
                        transport_special_handling_requirements: {
                            required: "Please enter special handling requirements"
                        },
                        transport_special_handling_details: {
                            required: "Please enter special handling details"
                        },
                        crew_assistance: {
                            required: "Please choose crew assistance"
                        },
                        crew_quantity: {
                            required: "Please enter crew qunatity"
                        },
                        supervisor_quantity: {
                            required: "Please enter supervisor quantity"
                        },
                        material_handling_equipment: {
                            required: "Please choose material handling equipment "
                        },
                        forklift_quantity: {
                            required: "Please enter forklift quantity"
                        },
                        pallet_jack_quantity: {
                            required: "Please enter pallet jack quantity"
                        },
                        trolley_quantity: {
                            required: "Please enter trolley quantity"
                        },
                        logistics_assistance_venue: {
                            required: "Please enter logistics assistance venue"
                        },
                        logistics_assistance_venue_details: {
                            required: "Please enter  assitance venue details"
                        },
                        short_breif_activity: {
                            required: "Please enter short breif activity"
                        },
                        location: {
                            required: "Please enter location"
                        },
                        ova_contact_name: {
                            required: "Please enter contact name"
                        },
                        start_date: {
                            required: "Please enter start date"
                        },
                        end_date: {
                            required: "Please enter end date"
                        },
                        start_time: {
                            required: "Please enter start time"
                        },
                        end_time: {
                            required: "Please enter end time"
                        },

                    },
                    submitHandler: function(form) {
                        form.submit();
                    }

                    // any other options and/or rules
                });
            });
        </script>
    @endpush
@endsection
