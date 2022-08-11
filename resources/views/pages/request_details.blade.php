@extends('layouts.base')

@section('content')
    @include('layouts.header', ['header_name' => 'Logistics Service Request Form'])
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
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-md-4 control-label">
                                        Name :
                                    </label>
                                    <div class="col-md-8">
                                        <input type="text" name="name" id="name" class="form-control input-md"
                                            disabled value="{{ $user_service_request->name }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="col-md-4 control-label">
                                        Email :
                                    </label>
                                    <div class="col-md-8">
                                        <input type="email" disabled value="{{ $user_service_request->email }}"
                                            name="email" id="email" class="form-control input-md" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="project_functional_area" class="col-md-5 control-label">
                                        Project/Functional Area :
                                    </label>
                                    <div class="col-md-7">
                                        <input type="text" name="project_functional_area" id="project_functional_area"
                                            class="form-control input-md"
                                            value="{{ $user_service_request->project_functional_area }}" disabled />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile" class="col-md-4 control-label">
                                        Mobile :
                                    </label>
                                    <div class="col-md-8">
                                        <input type="text" name="mobile" id="mobile" class="form-control input-md"
                                            value="{{ $user_service_request->mobile }}" disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="job_title" class="col-md-4 control-label">
                                        Job Title :
                                    </label>
                                    <div class="col-md-8">
                                        <input type="text" name="job_title"
                                            value="{{ $user_service_request->job_title }}" disabled id="job_title"
                                            class="form-control input-md" />
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
                                            @if ($user_service_request->service_id == 1) checked @endif disabled /> <span>
                                            Warehouse Storage
                                            Space </span> <br>
                                        <input type="radio" name="service" value="2"
                                            @if ($user_service_request->service_id == 2) checked @endif disabled /> <span>
                                            Transportation of
                                            Goods to Venues</span> <br>
                                        <input type="radio" name="service" value="3"
                                            @if ($user_service_request->service_id == 3) checked @endif disabled /> <span> On-Venue
                                            Assistance* (Crew, MHE, Other Venue Support)</span> <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($user_service_request->service_id == 1)
        <div class="container" id="warehouse_storage_space" style="padding:5px 0px;">
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
                                            id="description_of_materials" class="form-control input-width"
                                            value="{{ $user_service_request->warehouse_storage->description_of_materials }}"
                                            disabled />
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
                                            id="storage_type_id" disabled>
                                            @foreach ($storage_types as $storageType)
                                                <option @if ($user_service_request->warehouse_storage->storage_type_id == $storageType->id) selected @endif
                                                    value="{{ $storageType->id }}">{{ $storageType->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="quantity_of_items" class="control-label">
                                            Quantity of items :
                                        </label>
                                        <input type="number" name="quantity_of_items" id="quantity_of_items"
                                            class="form-control input-width"
                                            value="{{ $user_service_request->warehouse_storage->quantity_of_items }}"
                                            disabled />
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
                                            id="goods_preparation_type_id" disabled>
                                            @foreach ($goods_preparation_types as $goodsPreparationTypes)
                                                <option @if ($user_service_request->warehouse_storage->goods_preparation_type_id == $goodsPreparationTypes->id) selected @endif
                                                    value="{{ $goodsPreparationTypes->id }}">
                                                    {{ $goodsPreparationTypes->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_of_packaged_goods" class="control-label">
                                            Number of packaged goods :
                                        </label>
                                        <input type="number" name="no_of_packaged_goods" id="no_of_packaged_goods"
                                            class="form-control input-width"
                                            value="{{ $user_service_request->warehouse_storage->no_of_packaged_goods }}"
                                            disabled />
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
                                            id="packaging_specifications" class="form-control input-width"
                                            value="{{ $user_service_request->warehouse_storage->packaging_specifications }}"
                                            disabled />
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
                                            class="form-control input-width"
                                            value="{{ $user_service_request->warehouse_storage->weight_of_goods }}"
                                            disabled />
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
                                            class="form-control input-width"
                                            value="{{ $user_service_request->warehouse_storage->storage_start_date }}"
                                            disabled />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">
                                            Storage End Date :
                                        </label>
                                        <input type="text" name="storage_end_date" id="storage_end_date"
                                            class="form-control input-width"
                                            value="{{ $user_service_request->warehouse_storage->storage_end_date }}"
                                            disabled />

                                    </div>
                                </div>
                            </div>
                            <div class="row m-left-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="any_dangerous" class="control-label">
                                            Are there any Dangerous or Hazardous Goods? :
                                        </label>
                                        <select class="form-control input-width" name="any_dangerous" id="any_dangerous"
                                            disabled>
                                            <option @if ($user_service_request->warehouse_storage->any_dangerous == 'Yes') selected @endif value="Yes">
                                                Yes</option>
                                            <option @if ($user_service_request->warehouse_storage->any_dangerous == 'No') selected @endif value="No">No
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                @if ($user_service_request->warehouse_storage->any_dangerous == 'Yes')
                                    <div class="col-md-6" id="dangerous_details_div">
                                        <div class="form-group">
                                            <label for="dangerous_details" class="control-label">
                                                If YES, Please specify :
                                            </label>
                                            <input type="text" name="dangerous_details" id="dangerous_details"
                                                class="form-control input-width"
                                                value="{{ $user_service_request->warehouse_storage->dangerous_details }}"
                                                disabled />

                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row m-left-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dissolution_plan_place" class="control-label">
                                            Is there a dissolution plan in place? :
                                        </label>
                                        <select class="form-control input-width" name="dissolution_plan_place"
                                            id="dissolution_plan_place" disabled>
                                            <option @if ($user_service_request->warehouse_storage->dissolution_plan_place == 'Yes') selected @endif value="Yes">
                                                Yes</option>
                                            <option @if ($user_service_request->warehouse_storage->dissolution_plan_place == 'No') selected @endif value="No">No
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                @if ($user_service_request->warehouse_storage->dissolution_plan_place == 'Yes')
                                    <div class="col-md-6" id="dissolution_plan_details_div">
                                        <div class="form-group">
                                            <label for="dissolution_plan_details" class="control-label">
                                                If YES, Please specify :
                                            </label>
                                            <input type="text" name="dissolution_plan_details"
                                                id="dissolution_plan_details" class="form-control input-width"
                                                value="{{ $user_service_request->warehouse_storage->dissolution_plan_details }}"
                                                disabled />

                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row m-left-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="special_handling_requirements" class="control-label">
                                            Any special handling requirements from the supplier? :
                                        </label>
                                        <select class="form-control input-width" name="special_handling_requirements"
                                            id="special_handling_requirements" disabled>
                                            <option @if ($user_service_request->warehouse_storage->special_handling_requirements == 'Yes') selected @endif value="Yes">
                                                Yes</option>
                                            <option @if ($user_service_request->warehouse_storage->special_handling_requirements == 'No') selected @endif value="No">
                                                No</option>
                                        </select>
                                    </div>
                                </div>
                                @if ($user_service_request->warehouse_storage->special_handling_requirements == 'Yes')
                                    <div class="col-md-6" id="special_handling_details_div">
                                        <div class="form-group">
                                            <label for="special_handling_details" class="control-label">
                                                If YES, Please specify :
                                            </label>
                                            <input type="text" name="special_handling_details"
                                                id="special_handling_details" class="form-control input-width"
                                                value="{{ $user_service_request->warehouse_storage->special_handling_details }}"
                                                disabled />
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row m-left-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="transport_to_deliver" class="control-label">
                                            Will you provide the transport to deliver this to the Warehouse? :
                                        </label>
                                        <select class="form-control input-width" name="transport_to_deliver"
                                            id="transport_to_deliver" disabled>
                                            <option value="">-- Select --</option>
                                            <option @if ($user_service_request->warehouse_storage->transport_to_deliver == 'Yes') selected @endif value="Yes">
                                                Yes</option>
                                            <option @if ($user_service_request->warehouse_storage->transport_to_deliver == 'No') selected @endif value="No">
                                                No</option>
                                        </select>
                                    </div>
                                </div>
                                @if ($user_service_request->warehouse_storage->transport_to_deliver == 'Yes')
                                    <div class="col-md-6" id="transport_to_deliver_details_div">
                                        <div class="form-group">
                                            <label for="transport_to_deliver_details" class="control-label">
                                                If YES, Please specify :
                                            </label>
                                            <input disabled type="text" name="transport_to_deliver_details"
                                                id="transport_to_deliver_details" class="form-control input-width"
                                                value="{{ $user_service_request->warehouse_storage->transport_to_deliver_details }}" />

                                        </div>
                                    </div>
                                @endif
                            </div>
                            @if ($user_service_request->warehouse_storage->transport_to_deliver == 'No')
                                <div class="row m-left-20" id="collection_details_div">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="date_of_collection" class="control-label">
                                                Date of collection :
                                            </label>
                                            <input type="text" name="date_of_collection" id="date_of_collection"
                                                class="form-control collection-input-width"
                                                value="{{ $user_service_request->warehouse_storage->date_of_collection }}"
                                                disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="location_of_collection" class="control-label">
                                                Central Location of collection :
                                            </label>
                                            <input type="text" name="location_of_collection"
                                                id="location_of_collection" class="form-control collection-input-width"
                                                value="{{ $user_service_request->warehouse_storage->location_of_collection }}"
                                                disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="collection_contact_person" class="control-label">
                                                Contact person and number :
                                            </label>
                                            <input type="text" name="collection_contact_person"
                                                id="collection_contact_person" class="form-control collection-input-width"
                                                value="{{ $user_service_request->warehouse_storage->collection_contact_person }}"
                                                disabled />
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row m-left-20">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="venues_distribution" class="control-label">
                                            At the end of the requested storage period, do you require Logistics to
                                            provide
                                            the distribution to venues for the items? :
                                        </label>
                                        <select class="form-control input-width" name="venues_distribution"
                                            id="venues_distribution" disabled>
                                            <option @if ($user_service_request->warehouse_storage->venues_distribution == 'Yes') selected @endif value="Yes">
                                                Yes</option>
                                            <option @if ($user_service_request->warehouse_storage->venues_distribution == 'No') selected @endif value="No">
                                                No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @if ($user_service_request->warehouse_storage->venues_distribution == 'Yes')
                                <div class="row m-left-20" id="venue_details_div" style="display: none;">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="venues_distribution_date" class="control-label">
                                                Date :
                                            </label>
                                            <input type="text" name="venues_distribution_date"
                                                id="venues_distribution_date" class="form-control collection-input-width"
                                                value="{{ $user_service_request->warehouse_storage->venues_distribution_date }}"
                                                disabled />

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="venues_distribution_place" class="control-label">
                                                Venue :
                                            </label>
                                            <input type="text" name="venues_distribution_place"
                                                id="venues_distribution_place" class="form-control collection-input-width"
                                                value="{{ $user_service_request->warehouse_storage->venues_distribution_place }}"
                                                disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="venues_distribution_contact" class="control-label">
                                                Contact person and number :
                                            </label>
                                            <input type="text" name="venues_distribution_contact"
                                                id="venues_distribution_contact"
                                                class="form-control collection-input-width"
                                                value="{{ $user_service_request->warehouse_storage->venues_distribution_contact }}"
                                                disabled />
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($user_service_request->service_id == 2)
        <div class="container" id="transportation_goods_to_venues" style="padding:5px 0px;d">
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
                                            id="transport_description_of_materials" disabled
                                            class="form-control input-width"
                                            value="{{ $user_service_request->transportation_of_goods->description_of_materials }}" />
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
                                            id="transport_goods_preparation_type_id" disabled>
                                            @foreach ($goods_preparation_types as $goodsPreparationTypes)
                                                <option @if ($user_service_request->transportation_of_goods->goods_preparation_type_id == $goodsPreparationTypes->id) selected @endif
                                                    value="{{ $goodsPreparationTypes->id }}">
                                                    {{ $goodsPreparationTypes->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_of_packaged_goods" class="control-label">
                                            Number of packaged goods :
                                        </label>
                                        <input type="number" name="transport_no_of_packaged_goods"
                                            id="transport_no_of_packaged_goods" class="form-control input-width"
                                            value="{{ $user_service_request->transportation_of_goods->no_of_packaged_goods }}"
                                            disabled />
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
                                            id="transport_packaging_specifications" class="form-control input-width"
                                            value="{{ $user_service_request->transportation_of_goods->packaging_specifications }}"
                                            disabled />
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
                                            id="transport_weight_of_goods" class="form-control input-width"
                                            value="{{ $user_service_request->transportation_of_goods->weight_of_goods }}"
                                            disabled />
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
                                            id="transport_collection_dttm" class="form-control input-width"
                                            value="{{ $user_service_request->transportation_of_goods->collection_dttm }}"
                                            disabled />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="collection_location" class="control-label">
                                            Collection Location :
                                        </label>
                                        <input type="text" name="transport_collection_location"
                                            id="transport_collection_location" class="form-control input-width"
                                            value="{{ $user_service_request->transportation_of_goods->collection_location }}"
                                            disabled />
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
                                            id="transport_collection_contact_name" class="form-control input-width"
                                            value="{{ $user_service_request->transportation_of_goods->collection_contact_name }}"
                                            disabled />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="collection_contact_number" class="control-label">
                                            Collection Contact Number :
                                        </label>
                                        <input type="text" name="transport_collection_contact_number"
                                            id="transport_collection_contact_number" class="form-control input-width"
                                            value="{{ $user_service_request->transportation_of_goods->collection_contact_number }}"
                                            disabled />
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
                                            class="form-control input-width"
                                            value="{{ $user_service_request->transportation_of_goods->delivery_dttm }}"
                                            disabled />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="delivery_location" class="control-label">
                                            Delivery Location :
                                        </label>
                                        <input type="text" name="transport_delivery_location"
                                            id="transport_delivery_location" class="form-control input-width"
                                            value="{{ $user_service_request->transportation_of_goods->delivery_location }}"
                                            disabled />
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
                                            id="transport_delivery_contact_name" class="form-control input-width"
                                            value="{{ $user_service_request->transportation_of_goods->delivery_contact_name }}"
                                            disabled />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="delivery_contact_number" class="control-label">
                                            Delivery Contact Number :
                                        </label>
                                        <input type="text" name="transport_delivery_contact_number"
                                            id="transport_delivery_contact_number" class="form-control input-width"
                                            value="{{ $user_service_request->transportation_of_goods->delivery_contact_number }}"
                                            disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="row m-left-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="any_dangerous" class="control-label">
                                            Are there any Dangerous or Hazardous Goods? :
                                        </label>
                                        <select class="form-control input-width" name="transport_any_dangerous"
                                            id="transport_any_dangerous" disabled>
                                            <option @if ($user_service_request->transportation_of_goods->any_dangerous == 'Yes') selected @endif value="Yes">Yes
                                            </option>
                                            <option @if ($user_service_request->transportation_of_goods->any_dangerous == 'No') selected @endif value="No">No
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                @if ($user_service_request->transportation_of_goods->any_dangerous == 'Yes')
                                    <div class="col-md-6" id="transport_dangerous_details_div">
                                        <div class="form-group">
                                            <label for="dangerous_details" class="control-label">
                                                If YES, Please specify :
                                            </label>
                                            <input type="text" name="transport_dangerous_details"
                                                id="transport_dangerous_details" class="form-control input-width"
                                                value="{{ $user_service_request->transportation_of_goods->dangerous_details }}"
                                                disabled />
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row m-left-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="special_handling_requirements" class="control-label">
                                            Any special handling requirements from the supplier? :
                                        </label>
                                        <select class="form-control input-width"
                                            name="transport_special_handling_requirements"
                                            id="transport_special_handling_requirements" disabled>
                                            <option @if ($user_service_request->transportation_of_goods->special_handling_requirements == 'Yes') selected @endif value="Yes">Yes
                                            </option>
                                            <option @if ($user_service_request->transportation_of_goods->special_handling_requirements == 'No') selected @endif value="No">No
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                @if ($user_service_request->transportation_of_goods->special_handling_requirements == 'Yes')
                                    <div class="col-md-6" id="transport_special_handling_details_div">
                                        <div class="form-group">
                                            <label for="special_handling_details" class="control-label">
                                                If YES, Please specify :
                                            </label>
                                            <input type="text" name="transport_special_handling_details"
                                                id="transport_special_handling_details" class="form-control input-width"
                                                value="{{ $user_service_request->transportation_of_goods->special_handling_details }}"
                                                disabled />
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($user_service_request->service_id == 3)
        <div class="container" id="on_venue_assistance" style="padding:5px 0px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            On-Venue Assistance* (Crew, MHE, Other Venue Support)
                        </div>
                        <div class="panel-body" style="padding: 0px 25px;">
                            <div class="row m-left20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="crew_assistance" class="control-label">
                                            Do you require CREW assistance? :
                                        </label>
                                        <select class="form-control input-width" name="crew_assistance"
                                            id="crew_assistance" disabled>
                                            <option @if ($user_service_request->on_venue_assistance->crew_assistance == 'Yes') selected @endif value="Yes">Yes
                                            </option>
                                            <option @if ($user_service_request->on_venue_assistance->crew_assistance == 'No') selected @endif value="No">No
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @if($user_service_request->on_venue_assistance->crew_assistance == 'Yes')
                                <div id="crew_assistance_div">
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
                                                    value="{{ $user_service_request->on_venue_assistance->crew_quantity }}" disabled />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="supervisor_quantity" class="control-label">
                                                    Supervisor :
                                                </label>
                                                <input type="number" min="1" name="supervisor_quantity"
                                                    id="supervisor_quantity" placeholder="Supervisor Quantity"
                                                    class="form-control " value="{{ $user_service_request->on_venue_assistance->supervisor_quantity }}" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row m-left20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="material_handling_equipment" class="control-label">
                                            Do you require MHE (Material Handling Equipment)? :
                                        </label>
                                        <select class="form-control input-width" name="material_handling_equipment"
                                            id="material_handling_equipment" disabled>
                                            <option @if ($user_service_request->on_venue_assistance->material_handling_equipment == 'Yes') selected @endif value="Yes">Yes
                                            </option>
                                            <option @if ($user_service_request->on_venue_assistance->material_handling_equipment == 'No') selected @endif value="No">No
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @if($user_service_request->on_venue_assistance->material_handling_equipment == 'Yes')
                                <div id="material_handling_equipment_div">
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
                                                    class="form-control " value="{{ $user_service_request->on_venue_assistance->forklift_quantity }}" disabled/>
                                            </div>
                                        </div>
                                        <div class="col-md-3" style="margin-right: 50px;">
                                            <div class="form-group">
                                                <label for="pallet_jack_quantity" class="control-label">
                                                    Pallet Jack :
                                                </label>
                                                <input type="number" min="1" name="pallet_jack_quantity"
                                                    id="pallet_jack_quantity" placeholder="Pallet Jack Quantity"
                                                    class="form-control " value="{{ $user_service_request->on_venue_assistance->pallet_jack_quantity }}" disabled/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="trolley_quantity" class="control-label">
                                                    Trolley :
                                                </label>
                                                <input type="number" min="1" name="trolley_quantity"
                                                    id="trolley_quantity" placeholder="Trolley Quantity"
                                                    class="form-control " value="{{ $user_service_request->on_venue_assistance->trolley_quantity }}" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row m-left20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="logistics_assistance_venue" class="control-label">
                                            Do you require other Logistics assistance on Venue :
                                        </label>
                                        <select class="form-control input-width" name="logistics_assistance_venue"
                                            id="logistics_assistance_venue" disabled>
                                            <option @if ($user_service_request->on_venue_assistance->logistics_assistance_venue == 'Yes') selected @endif value="Yes">Yes
                                            </option>
                                            <option @if ($user_service_request->on_venue_assistance->logistics_assistance_venue == 'No') selected @endif value="No">No
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                @if($user_service_request->on_venue_assistance->logistics_assistance_venue == 'Yes')
                                    <div class="col-md-6" id="logistics_assistance_venue_div" style="display: none;">
                                        <div class="form-group">
                                            <label for="logistics_assistance_venue_details" class="control-label">
                                                If yes, please specify
                                            </label>
                                            <input type="text" name="logistics_assistance_venue_details"
                                                id="logistics_assistance_venue_details" placeholder="If yes, please specify"
                                                class="form-control input-width"
                                                value="{{ $user_service_request->on_venue_assistance->logistics_assistance_venue_details }}" disabled/>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row m-left20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="short_breif_activity" class="control-label">
                                            Provide a short brief of the activity :
                                        </label>
                                        <input type="text" name="short_breif_activity" id="short_breif_activity"
                                            placeholder="Provide a short brief of the activity"
                                            class="form-control input-width" value="{{ $user_service_request->on_venue_assistance->short_breif_activity }}" disabled/>
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
                                            class="form-control" value="{{ $user_service_request->on_venue_assistance->location }}" style="width: 250px;" disabled/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ova_contact_name" class="control-label">
                                            Contact Name :
                                        </label>
                                        <input type="text" name="ova_contact_name" id="ova_contact_name"
                                            placeholder="Contact Name" class="form-control "
                                            value="{{ $user_service_request->on_venue_assistance->contact_name }}" style="width: 250px;" disabled />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_number" class="control-label">
                                            Contact Number :
                                        </label>
                                        <input type="text" name="ova_contact_number" id="ova_contact_number"
                                            placeholder="Contact Number" class="form-control "
                                            value="{{ $user_service_request->on_venue_assistance->contact_number }}" style="width: 250px;" disabled />
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
                                            class="form-control input-width" value="{{ $user_service_request->on_venue_assistance->start_date }}" disabled />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_time" class="control-label">
                                            Start Time :
                                        </label>
                                        <input type="text" name="start_time" id="start_time" placeholder="Start Date"
                                            class="form-control input-width" value="{{ $user_service_request->on_venue_assistance->start_time }}" disabled/>
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
                                            class="form-control input-width" value="{{ $user_service_request->on_venue_assistance->end_date }}" disabled />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_time" class="control-label">
                                            End Time :
                                        </label>
                                        <input type="text" name="end_time" id="end_time" placeholder="End Date"
                                            class="form-control input-width" value="{{ $user_service_request->on_venue_assistance->end_time }}" disabled />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
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

                $('#transport_collection_dttm').datetimepicker({
                    format: 'Y-MM-DD',
                });

                $('#transport_delivery_dttm').datetimepicker({
                    format: 'Y-MM-DD',
                });

                $('#start_date').datetimepicker({
                    format: 'Y-MM-DD',
                });

                $('#end_date').datetimepicker({
                    format: 'Y-MM-DD',
                });

                $('#start_time').datetimepicker({
                    format: 'hh:mm'
                    ampm: true,
                });

                $('#end_time').datetimepicker({
                    format : 'hh:mm A'
                });
            });
        </script>
    @endpush
@endsection
