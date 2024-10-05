<?php
function compare_info($packages, $origin, $destination, $date, $nights) {
    $matching_package = [];
    if ($packages) {
        foreach ($packages as $package) {
            if (strtolower($package['origin']) == strtolower($origin) && 
            strtolower($package['destination']) == strtolower($destination) && 
            in_array($date, $package['dates']))  {
                $matching_package[] = $package;
            }
        }
        if (!empty($matching_package)) {
            $first_package = $matching_package[0];
            $new_package = create_package($first_package, $date, $nights);
            return $new_package;
        }
    }
}

function create_package($pkg, $date, $nights) {
    $new_package = new Package($pkg['hotel'], $pkg['destination'], $pkg['country'], $date, $nights);
    return $new_package;
}

function add_suggestions($packages, $date, $nights, $destination) {
    $random_index = array_rand($packages);
    $pkg = $packages[$random_index];
    
    if ($pkg['destination'] != $destination) {
        $suggestion = new Package($pkg['hotel'], $pkg['destination'], $pkg['country'], $date, $nights);
    } else {
        add_suggestions($packages, $date, $nights, $destination);
    }
    if ($suggestion == NULL) {
        $suggestion = add_suggestions($packages, $date, $nights, $destination);
    }
    return $suggestion;
}

function new_pkg_string($new_package) {
    $pkg_string = "Vacaciones en " . $new_package->city . " por " . $new_package->nights . " noches";
    return $pkg_string;
}
