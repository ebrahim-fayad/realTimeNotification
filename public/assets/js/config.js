"use strict";

// الأساسيات والألوان
var base = {
    defaultFontFamily: "Overpass, sans-serif",
    primaryColor: "#1b68ff",
    secondaryColor: "#4f4f4f",
    successColor: "#3ad29f",
    warningColor: "#ffc107",
    infoColor: "#17a2b8",
    dangerColor: "#dc3545",
    darkColor: "#343a40",
    lightColor: "#f2f3f6",
};

var extend = {
    primaryColorLight: tinycolor(base.primaryColor).lighten(10).toString(),
    primaryColorLighter: tinycolor(base.primaryColor).lighten(30).toString(),
    primaryColorDark: tinycolor(base.primaryColor).darken(10).toString(),
    primaryColorDarker: tinycolor(base.primaryColor).darken(30).toString(),
};

var chartColors = [
    base.primaryColor,
    base.successColor,
    "#6f42c1",
    extend.primaryColorLighter,
];

// الألوان الافتراضية والثيم الليلي
var colors = {
    bodyColor: "#6c757d",
    headingColor: "#495057",
    borderColor: "#e9ecef",
    backgroundColor: "#f8f9fa",
    mutedColor: "#adb5bd",
    chartTheme: "light",
};

var darkColor = {
    bodyColor: "#adb5bd",
    headingColor: "#e9ecef",
    borderColor: "#212529",
    backgroundColor: "#495057",
    mutedColor: "#adb5bd",
    chartTheme: "dark",
};

// قراءة الثيم الحالي من localStorage
var curentTheme = localStorage.getItem("mode");

// عناصر الـ DOM
var dark = document.querySelector("#darkTheme");
var light = document.querySelector("#lightTheme");
var switcher = document.querySelector("#modeSwitcher");

// الدالة لتبديل الثيم
function modeSwitch() {
    console.log("abc");
    var mode = localStorage.getItem("mode");

    if (mode) {
        if (mode === "dark") {
            dark.disabled = true;
            light.disabled = false;
            localStorage.setItem("mode", "light");
        } else {
            dark.disabled = false;
            light.disabled = true;
            localStorage.setItem("mode", "dark");
        }
    } else if ($("body").hasClass("dark")) {
        dark.disabled = false;
        light.disabled = true;
        localStorage.setItem("mode", "dark");
    } else {
        dark.disabled = true;
        light.disabled = false;
        localStorage.setItem("mode", "light");
    }
}

// عند تحميل الصفحة: تطبيق الثيم المحفوظ
console.log(curentTheme);

if (curentTheme) {
    if (curentTheme === "dark") {
        dark.disabled = false;
        light.disabled = true;
        colors = darkColor;
    } else if (curentTheme === "light") {
        dark.disabled = true;
        light.disabled = false;
    }

    if (switcher) {
        switcher.dataset.mode = curentTheme;
    }
} else {
    if ($("body").hasClass("dark")) {
        colors = darkColor;
        localStorage.setItem("mode", "dark");
    } else {
        localStorage.setItem("mode", "light");
    }
}
