import "./bootstrap";

import.meta.glob(["../images/**"]);

import Alpine from "alpinejs";

window.Alpine = Alpine;

import uniqolor from "uniqolor";

window.uniqolor = uniqolor;

Alpine.start();
