import { useTranslation } from "react-i18next";
import React, { useState } from "react";

export const RightSideBar = () => {
    const [dropdownStates, setDropdownStates] = useState({
        dropdown1: false,
        dropdown2: false,
        // Add more dropdown states as needed
    });

    const toggleDropdown = (dropdown) => {
        setDropdownStates((prevState) => ({
            ...prevState,
            [dropdown]: !prevState[dropdown],
        }));
    };

    return (
        <nav className="bg-gray-800 p-4 relative">
            <div className="max-w-7xl mx-auto">
                <div className="flex justify-between">
                    <div className="flex space-x-4">
                        <div className="text-white">Logo</div>
                        <a href="#" className="text-white">
                            Link 1
                        </a>
                        <a href="#" className="text-white">
                            Link 2
                        </a>
                    </div>
                    <div className="flex space-x-4">
                        <div className="relative">
                            <button
                                className="text-white focus:outline-none"
                                onClick={() => toggleDropdown("dropdown1")}
                            >
                                Dropdown 1
                            </button>
                        </div>
                        <div className="relative">
                            <button
                                className="text-white focus:outline-none"
                                onClick={() => toggleDropdown("dropdown2")}
                            >
                                Dropdown 2
                            </button>
                        </div>
                        {/* Add more buttons as needed */}
                    </div>
                </div>
            </div>
            {dropdownStates.dropdown1 && (
                <div className="absolute mt-2 left-0 w-48 bg-white shadow-lg rounded-md">
                    <a
                        href="#"
                        className="block px-4 py-2 text-gray-800 hover:bg-gray-200"
                    >
                        Option 1
                    </a>
                    <a
                        href="#"
                        className="block px-4 py-2 text-gray-800 hover:bg-gray-200"
                    >
                        Option 2
                    </a>
                    <a
                        href="#"
                        className="block px-4 py-2 text-gray-800 hover:bg-gray-200"
                    >
                        Option 3
                    </a>
                </div>
            )}
            {dropdownStates.dropdown2 && (
                <div className="absolute mt-2 left-0 w-48 bg-white shadow-lg rounded-md">
                    <a
                        href="#"
                        className="block px-4 py-2 text-gray-800 hover:bg-gray-200"
                    >
                        Option A
                    </a>
                    <a
                        href="#"
                        className="block px-4 py-2 text-gray-800 hover:bg-gray-200"
                    >
                        Option B
                    </a>
                    <a
                        href="#"
                        className="block px-4 py-2 text-gray-800 hover:bg-gray-200"
                    >
                        Option C
                    </a>
                </div>
            )}
            {/* Add more dropdown menus as needed */}
        </nav>
    );
};
