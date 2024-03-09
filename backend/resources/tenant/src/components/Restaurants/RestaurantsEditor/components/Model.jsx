import React, { useState, useEffect } from "react";
import { globalColor, globalShape } from "../../../../redux/editor/buttonSlice";
import { useSelector } from "react-redux";
import { useTranslation } from "react-i18next";
import { HiOutlineLocationMarker } from "react-icons/hi";
import { BiSearch } from "react-icons/bi";
import { MdKeyboardArrowDown } from "react-icons/md";

const Model = ({ buttonId }) => {
    const GlobalColor = useSelector(globalColor);
    const GlobalShape = useSelector(globalShape);
    const Language = useSelector((state) => state.languageMode.languageMode);
    const { t } = useTranslation();
    const [cities, setCities] = useState([]);
    const [restaurants, setRestaurants] = useState([]);
    const [selectedCity, setSelectedCity] = useState("");
    const [selectedRestaurant, setSelectedRestaurant] = useState("");

    // API GET REQUEST For City
    useEffect(() => {
        const fetchDataFromCities = async () => {
            try {
                const response = await fetch("");
                const jsonData = await response.json();
                setCities(jsonData);
            } catch (error) {
                console.error("", error);
            }
        };

        fetchDataFromCities();
    }, []);

    // API GET REQUEST For Restaurants
    useEffect(() => {
        const fetchDataFromRestaurants = async () => {
            try {
                const response = await fetch("");
                const jsonData = await response.json();
                setRestaurants(jsonData);
            } catch (error) {
                console.error("", error);
            }
        };

        fetchDataFromRestaurants();
    }, []);

    return (
        <>
            {buttonId == 1 ? (
                <div
                    className={`absolute top-[55px] min-w-[250px] ${
                        Language == "en" ? "left-0" : "right-0"
                    } z-[999999999999999999] p-3 shadow-md bg-white rounded-lg text-black`}
                >
                    <div className="flex flex-col justify-start items-start gap-2 gap-y-3 flex-wrap">
                        <div className="border-b border-ternary-light w-[100%] pb-3">
                            {t("restaurant location")}
                        </div>
                        <div className="w-[100%]">
                            <label
                                for="city"
                                class="block mb-2 text-md text-start font-bold"
                            >
                                {t("City")}
                            </label>
                            <div className="relative">
                                <select
                                    id="city"
                                    className="text-[14px] bg-[var(--secondary)] w-[100%] p-2 rounded-full px-4 appearance-none"
                                    value={selectedCity}
                                    onChange={(e) =>
                                        setSelectedCity(e.target.value)
                                    }
                                >
                                    {cities.map((city) => (
                                        <option
                                            className="bg-white text-black"
                                            key={city.id}
                                            value={city.value}
                                        >
                                            {city.label}
                                        </option>
                                    ))}
                                </select>
                                <MdKeyboardArrowDown
                                    className={`absolute top-1/2 ${
                                        Language == "en" ? "right-4" : "left-4"
                                    } transform -translate-y-1/2 text-black`}
                                />
                            </div>
                        </div>
                        <div className="w-[100%]">
                            <label
                                for="restaurant"
                                class="block mb-2 text-md text-start text-black font-bold"
                            >
                                {t("Restaurant")}
                            </label>
                            <div className="relative">
                                <select
                                    id="restaurant"
                                    className="text-[14px] bg-[var(--secondary)] w-[100%] p-2 rounded-full px-4 appearance-none"
                                    value={selectedRestaurant}
                                    onChange={(e) =>
                                        setSelectedRestaurant(e.target.value)
                                    }
                                >
                                    {restaurants.map((restaurant) => (
                                        <option
                                            className="bg-white text-black"
                                            key={restaurant.id}
                                            value={restaurant.value}
                                        >
                                            {restaurant.label}
                                        </option>
                                    ))}
                                </select>
                                <MdKeyboardArrowDown
                                    className={`absolute top-1/2 ${
                                        Language == "en" ? "right-4" : "left-4"
                                    } transform -translate-y-1/2 text-black`}
                                />
                            </div>
                        </div>
                        <button
                            style={{
                                borderRadius: GlobalShape,
                                border: `1px solid ${GlobalColor}`,
                            }}
                            className="flex justify-center items-center gap-2 p-1 px-4 text-[16px]"
                        >
                            <h2>{t("Use my site")}</h2>
                            <div style={{ color: GlobalColor }}>
                                <HiOutlineLocationMarker />
                            </div>
                        </button>
                        <div className="flex justify-center items-center w-[100%]">
                            <button
                                className="p-1 px-4 text-[16px] text-white"
                                style={{
                                    borderRadius: GlobalShape,
                                    backgroundColor: GlobalColor,
                                }}
                            >
                                {t("Save")}
                            </button>
                        </div>
                    </div>
                </div>
            ) : (
                <div></div>
            )}
            {buttonId == 2 ? (
                <div
                    className={`absolute top-[55px] min-w-[260px] ${
                        Language == "en" ? "left-0" : "right-0"
                    } z-[999999999999999999] p-3 shadow-md bg-white rounded-lg text-black`}
                >
                    <div className="flex flex-col justify-start items-start gap-2 gap-y-3 flex-wrap">
                        <div className="border-b border-ternary-light w-[100%] pb-3">
                            {t("delivery location")}
                        </div>
                        <div className="relative w-[100%]">
                            <div
                                className={`text-gray-300 absolute inset-y-0 ${
                                    Language == "en" ? "right-0" : "left-0"
                                } flex items-center pe-3 pointer-events-none`}
                            >
                                <BiSearch />
                            </div>
                            <input
                                type="search"
                                id="default-search"
                                className="text-[14px] bg-[var(--secondary)] w-[100%] p-2 rounded-full px-4 appearance-none"
                                placeholder={t("Search")}
                                required
                            />
                        </div>
                        <div className="flex justify-center items-center w-[100%]">
                            <button
                                className="p-1 px-4 text-[16px] text-white"
                                style={{
                                    borderRadius: GlobalShape,
                                    backgroundColor: GlobalColor,
                                }}
                            >
                                {t("Save")}
                            </button>
                        </div>
                    </div>
                </div>
            ) : (
                <div></div>
            )}
        </>
    );
};

export default Model;
