<?php

namespace App\Enums;

enum TruckBodyTypeEnum: string
{
    case GENERAL_CARGO = 'General Cargo';
    case DRY_VAN_BOX_TRUCK = 'Dry van / Box truck';
    case CURTAINSIDER = 'Curtainsider';
    case DROPSIDE = 'Dropside';
    case WING_VAN = 'Wing van';
    case FLATBED = 'Flatbed';
    case TEMPERATURE_CONTROLLED = 'Temperature Controlled';
    case REEFER_TRUCK_FREEZER = 'Reefer truck (Freezer)';
    case CHILLER_TRUCK = 'Chiller truck';
    case INSULATED_VAN = 'Insulated van';
    case CONSTRUCTION_HEAVY = 'Construction / Heavy';
    case TIPPER_DUMP_TRUCK = 'Tipper / Dump truck';
    case MIXER_TRUCK = 'Mixer truck';
    case LOWBED_TRAILER = 'Lowbed trailer';
    case FLATBED_WITH_CRANE = 'Flatbed with crane';
    case HOOK_LIFT_ROLL_OFF_CONTAINER_TRUCK = 'Hook lift / Roll-off container truck';
    case TANKER_FUEL_WATER_CHEMICALS = 'Tanker (fuel, water, chemicals)';
    case CAR_CARRIER = 'Car carrier';
    case LIVESTOCK_TRUCK = 'Livestock truck';
    case GARBAGE_COMPACTOR = 'Garbage compactor';
    case VACUUM_TRUCK = 'Vacuum truck';
    case BULK_CARRIER_CEMENT_GRAIN = 'Bulk carrier (cement, grain)';
    case LOG_CARRIER = 'Log carrier';
    case AMBULANCE_TRUCK_BODY = 'Ambulance truck body';
    case FIRE_TRUCK_BODY = 'Fire truck body';
}
