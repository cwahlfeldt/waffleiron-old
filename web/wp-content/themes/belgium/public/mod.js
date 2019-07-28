//
// tsc init w/ testing
define("index", ["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    var args;
    args[0] = hello;
    args[1] = helloAgain;
    // main function
    exports.default = (function (args) {
        args[0]('waffles');
        args[1]('suck it!');
        return 0;
    })(args.slice());
    function hello(name) {
        alert("" + name);
    }
    function helloAgain(name) {
        alert("" + name);
    }
});
//# sourceMappingURL=mod.js.map