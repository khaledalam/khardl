import React, { useEffect, useState } from "react";
import Herosection from "./components/Herosection";
import ProductSection from "./components/ProductSection";
import FooterRestuarant from "./components/Footer";
import AxiosInstance from "../../axios/axios";
import { useDispatch, useSelector } from "react-redux";
import { changeRestuarantEditorStyle } from "../../redux/NewEditor/restuarantEditorSlice";
import {
  getCartItemsCount,
  selectedCategoryAPI,
  setCategoriesAPI,
} from "../../redux/NewEditor/categoryAPISlice";
import { Helmet } from "react-helmet";
import { useTranslation } from "react-i18next";

const DummyData = {
  data: [
    {
      id: 1,
      name: "First Category",
      photo: "http://newfly.khardl:8000/img/category-icon.png",
      created_at: "2024-01-15 16:25:25",
      updated_at: "2024-01-15 16:25:25",
      branch: {
        id: 1,
        name: "Branch 1",
        phone: "966123456789",
        address: "Riyadh",
        lat: "37.70000000",
        lng: "37.70000000",
        monday_open: "18:25:00",
        monday_close: "19:25:00",
        monday_closed: 0,
        tuesday_open: "19:25:00",
        tuesday_close: "20:25:00",
        tuesday_closed: 0,
        wednesday_open: "20:25:00",
        wednesday_close: "21:25:00",
        wednesday_closed: 0,
        thursday_open: "21:25:00",
        thursday_close: "22:25:00",
        thursday_closed: 0,
        friday_open: "22:25:00",
        friday_close: "23:25:00",
        friday_closed: 0,
        saturday_open: "16:25:00",
        saturday_close: "17:25:00",
        saturday_closed: 0,
        sunday_open: "17:25:00",
        sunday_close: "18:25:00",
        sunday_closed: 0,
        is_primary: 1,
        delivery_availability: 0,
        pickup_availability: 1,
        preparation_time_delivery: "00:30:00",
        created_at: "2024-01-15T13:25:25.000000Z",
        updated_at: "2024-01-15T13:25:25.000000Z",
      },
      user: {
        id: 4,
        first_name: "Worker",
        last_name: "Worker",
        email: "worker@first.com",
        phone: "966000000000",
        phone_verified_at: "2024-01-15T13:25:25.000000Z",
        status: "active",
        last_login: null,
        msegat_id_verification: null,
        address: "test address",
        tap_verified: 0,
        tap_customer_id: "cus_TS03A3920231337Jw212412549",
        lat: "24.71360000",
        lng: "46.67530000",
        branch_id: 1,
        created_at: "2024-01-15T13:25:25.000000Z",
        updated_at: "2024-01-15T13:25:25.000000Z",
      },
      items: [
        {
          id: 1,
          photo: "http://newfly.khardl:8000/tenancy/assets/seeders/items/1.jpg",
          price: "440.00",
          calories: 110,
          name: "Item 1",
          description: "Description 1",
          availability: 1,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
        {
          id: 2,
          photo: "http://newfly.khardl:8000/tenancy/assets/seeders/items/2.jpg",
          price: "61.00",
          calories: 14,
          name: "Item 2",
          description: "Description 2",
          availability: 1,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
        {
          id: 3,
          photo: "http://newfly.khardl:8000/tenancy/assets/seeders/items/3.jpg",
          price: "398.00",
          calories: 125,
          name: "Item 3",
          description: "Description 3",
          availability: 0,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
        {
          id: 4,
          photo: "http://newfly.khardl:8000/tenancy/assets/seeders/items/4.jpg",
          price: "464.00",
          calories: 32,
          name: "Item 4",
          description: "Description 4",
          availability: 0,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
        {
          id: 5,
          photo: "http://newfly.khardl:8000/tenancy/assets/seeders/items/5.jpg",
          price: "214.00",
          calories: 112,
          name: "Item 5",
          description: "Description 5",
          availability: 0,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
      ],
    },
    {
      id: 4,
      name: "Second Category",
      photo: "http://newfly.khardl:8000/img/category-icon.png",
      created_at: "2024-01-15 16:25:25",
      updated_at: "2024-01-15 16:25:25",
      branch: {
        id: 1,
        name: "Branch 1",
        phone: "966123456789",
        address: "Riyadh",
        lat: "37.70000000",
        lng: "37.70000000",
        monday_open: "18:25:00",
        monday_close: "19:25:00",
        monday_closed: 0,
        tuesday_open: "19:25:00",
        tuesday_close: "20:25:00",
        tuesday_closed: 0,
        wednesday_open: "20:25:00",
        wednesday_close: "21:25:00",
        wednesday_closed: 0,
        thursday_open: "21:25:00",
        thursday_close: "22:25:00",
        thursday_closed: 0,
        friday_open: "22:25:00",
        friday_close: "23:25:00",
        friday_closed: 0,
        saturday_open: "16:25:00",
        saturday_close: "17:25:00",
        saturday_closed: 0,
        sunday_open: "17:25:00",
        sunday_close: "18:25:00",
        sunday_closed: 0,
        is_primary: 1,
        delivery_availability: 0,
        pickup_availability: 1,
        preparation_time_delivery: "00:30:00",
        created_at: "2024-01-15T13:25:25.000000Z",
        updated_at: "2024-01-15T13:25:25.000000Z",
      },
      user: {
        id: 4,
        first_name: "Worker",
        last_name: "Worker",
        email: "worker@first.com",
        phone: "966000000000",
        phone_verified_at: "2024-01-15T13:25:25.000000Z",
        status: "active",
        last_login: null,
        msegat_id_verification: null,
        address: "test address",
        tap_verified: 0,
        tap_customer_id: "cus_TS03A3920231337Jw212412549",
        lat: "24.71360000",
        lng: "46.67530000",
        branch_id: 1,
        created_at: "2024-01-15T13:25:25.000000Z",
        updated_at: "2024-01-15T13:25:25.000000Z",
      },
      items: [
        {
          id: 31,
          photo: "http://newfly.khardl:8000/tenancy/assets/seeders/items/1.jpg",
          price: "10.00",
          calories: 267,
          name: "Item 1",
          description: "Description 1",
          availability: 0,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
        {
          id: 32,
          photo: "http://newfly.khardl:8000/tenancy/assets/seeders/items/2.jpg",
          price: "205.00",
          calories: 26,
          name: "Item 2",
          description: "Description 2",
          availability: 0,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
        {
          id: 33,
          photo: "http://newfly.khardl:8000/tenancy/assets/seeders/items/3.jpg",
          price: "327.00",
          calories: 55,
          name: "Item 3",
          description: "Description 3",
          availability: 0,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
        {
          id: 34,
          photo: "http://newfly.khardl:8000/tenancy/assets/seeders/items/4.jpg",
          price: "143.00",
          calories: 208,
          name: "Item 4",
          description: "Description 4",
          availability: 0,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
        {
          id: 35,
          photo: "http://newfly.khardl:8000/tenancy/assets/seeders/items/5.jpg",
          price: "26.00",
          calories: 5,
          name: "Item 5",
          description: "Description 5",
          availability: 0,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
        {
          id: 36,
          photo:
            "http://newfly.khardl:8000/tenancy/assets/seeders/items/6.webp",
          price: "354.00",
          calories: 146,
          name: "Item 6",
          description: "Description 6",
          availability: 1,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
        {
          id: 37,
          photo: "http://newfly.khardl:8000/tenancy/assets/seeders/items/7.jpg",
          price: "104.00",
          calories: 454,
          name: "Item 7",
          description: "Description 7",
          availability: 0,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
        {
          id: 38,
          photo: "http://newfly.khardl:8000/tenancy/assets/seeders/items/8.jpg",
          price: "138.00",
          calories: 121,
          name: "Item 8",
          description: "Description 8",
          availability: 0,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
        {
          id: 39,
          photo: "http://newfly.khardl:8000/tenancy/assets/seeders/items/9.jpg",
          price: "470.00",
          calories: 49,
          name: "Item 9",
          description: "Description 9",
          availability: 1,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
        {
          id: 40,
          photo:
            "http://newfly.khardl:8000/tenancy/assets/seeders/items/10.jpg",
          price: "17.00",
          calories: 247,
          name: "Item 10",
          description: "Description 10",
          availability: 1,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
      ],
    },
    {
      id: 5,
      name: "Third Category",
      photo: "http://newfly.khardl:8000/img/category-icon.png",
      created_at: "2024-01-15 16:25:25",
      updated_at: "2024-01-15 16:25:25",
      branch: {
        id: 1,
        name: "Branch 1",
        phone: "966123456789",
        address: "Riyadh",
        lat: "37.70000000",
        lng: "37.70000000",
        monday_open: "18:25:00",
        monday_close: "19:25:00",
        monday_closed: 0,
        tuesday_open: "19:25:00",
        tuesday_close: "20:25:00",
        tuesday_closed: 0,
        wednesday_open: "20:25:00",
        wednesday_close: "21:25:00",
        wednesday_closed: 0,
        thursday_open: "21:25:00",
        thursday_close: "22:25:00",
        thursday_closed: 0,
        friday_open: "22:25:00",
        friday_close: "23:25:00",
        friday_closed: 0,
        saturday_open: "16:25:00",
        saturday_close: "17:25:00",
        saturday_closed: 0,
        sunday_open: "17:25:00",
        sunday_close: "18:25:00",
        sunday_closed: 0,
        is_primary: 1,
        delivery_availability: 0,
        pickup_availability: 1,
        preparation_time_delivery: "00:30:00",
        created_at: "2024-01-15T13:25:25.000000Z",
        updated_at: "2024-01-15T13:25:25.000000Z",
      },
      user: {
        id: 4,
        first_name: "Worker",
        last_name: "Worker",
        email: "worker@first.com",
        phone: "966000000000",
        phone_verified_at: "2024-01-15T13:25:25.000000Z",
        status: "active",
        last_login: null,
        msegat_id_verification: null,
        address: "test address",
        tap_verified: 0,
        tap_customer_id: "cus_TS03A3920231337Jw212412549",
        lat: "24.71360000",
        lng: "46.67530000",
        branch_id: 1,
        created_at: "2024-01-15T13:25:25.000000Z",
        updated_at: "2024-01-15T13:25:25.000000Z",
      },
      items: [
        {
          id: 41,
          photo: "http://newfly.khardl:8000/tenancy/assets/seeders/items/1.jpg",
          price: "316.00",
          calories: 119,
          name: "Item 1",
          description: "Description 1",
          availability: 1,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
        {
          id: 42,
          photo: "http://newfly.khardl:8000/tenancy/assets/seeders/items/2.jpg",
          price: "29.00",
          calories: 390,
          name: "Item 2",
          description: "Description 2",
          availability: 0,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
        {
          id: 43,
          photo: "http://newfly.khardl:8000/tenancy/assets/seeders/items/3.jpg",
          price: "316.00",
          calories: 313,
          name: "Item 3",
          description: "Description 3",
          availability: 0,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
        {
          id: 44,
          photo: "http://newfly.khardl:8000/tenancy/assets/seeders/items/4.jpg",
          price: "86.00",
          calories: 51,
          name: "Item 4",
          description: "Description 4",
          availability: 0,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
        {
          id: 45,
          photo: "http://newfly.khardl:8000/tenancy/assets/seeders/items/5.jpg",
          price: "396.00",
          calories: 494,
          name: "Item 5",
          description: "Description 5",
          availability: 1,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
        {
          id: 46,
          photo:
            "http://newfly.khardl:8000/tenancy/assets/seeders/items/6.webp",
          price: "92.00",
          calories: 218,
          name: "Item 6",
          description: "Description 6",
          availability: 1,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
        {
          id: 47,
          photo: "http://newfly.khardl:8000/tenancy/assets/seeders/items/7.jpg",
          price: "215.00",
          calories: 307,
          name: "Item 7",
          description: "Description 7",
          availability: 1,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
        {
          id: 48,
          photo: "http://newfly.khardl:8000/tenancy/assets/seeders/items/8.jpg",
          price: "368.00",
          calories: 257,
          name: "Item 8",
          description: "Description 8",
          availability: 0,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
        {
          id: 49,
          photo: "http://newfly.khardl:8000/tenancy/assets/seeders/items/9.jpg",
          price: "259.00",
          calories: 101,
          name: "Item 9",
          description: "Description 9",
          availability: 1,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
        {
          id: 50,
          photo:
            "http://newfly.khardl:8000/tenancy/assets/seeders/items/10.jpg",
          price: "110.00",
          calories: 247,
          name: "Item 10",
          description: "Description 10",
          availability: 1,
          checkbox_required: null,
          checkbox_input_titles: null,
          checkbox_input_maximum_choices: null,
          checkbox_input_names: null,
          checkbox_input_prices: null,
          selection_required: null,
          selection_input_names: null,
          selection_input_prices: null,
          selection_input_titles: null,
          dropdown_required: null,
          dropdown_input_names: null,
          dropdown_input_titles: null,
        },
      ],
    },
  ],
};

export const RestuarantHomePage = () => {
  const dispatch = useDispatch();
  const { t } = useTranslation();
  const [isMobile, setIsMobile] = useState(false);
  const [isLoading, setisLoading] = useState(true);
  const categories = useSelector((state) => state.categoryAPI.categories);
  const [dummyData, setDummyData] = useState(DummyData.data);

  const restaurantStyle = useSelector((state) => state.restuarantEditorStyle);

  let branch_id = localStorage.getItem("selected_branch_id");
  // let branch_id = 2

  console.log("categories", categories);
  const fetchCategoriesData = async () => {
    try {
      const restaurantCategoriesResponse = await AxiosInstance.get(
        `categories?items&user&branch${branch_id ? `&selected_branch_id=${branch_id}` : ''}`
      )

      console.log("Richa", restaurantCategoriesResponse.data);
      if (restaurantCategoriesResponse.data) {
        dispatch(setCategoriesAPI(restaurantCategoriesResponse.data?.data));
        dispatch(
          selectedCategoryAPI({
            name: restaurantCategoriesResponse.data?.data[0].name,
            id: restaurantCategoriesResponse.data?.data[0].id,
          })
        );
        setisLoading(false);
        console.log(">> branch_id >>", branch_id);

        if (!branch_id) {
          branch_id = restaurantCategoriesResponse.data?.data[0]?.branch?.id;
          localStorage.setItem("selected_branch_id", branch_id);
        }
      }
    } catch (error) {
      // toast.error(`${t('Failed to send verification code')}`)
      console.log(error);
      setisLoading(false);
    }
  };
  const fetchResStyleData = async () => {
    try {
      AxiosInstance.get(`restaurant-style`).then((response) =>
        dispatch(changeRestuarantEditorStyle(response.data?.data))
      );
      setisLoading(false);
    } catch (error) {
      // toast.error(`${t('Failed to send verification code')}`)
      console.log(error);
      setisLoading(false);
    }
  };
  useEffect(() => {
    const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

    setIsMobile(isMobile);
  }, []);

  const fetchCartData = async () => {
    try {
      const cartResponse = await AxiosInstance.get(`carts`);
      if (cartResponse.data) {
        dispatch(getCartItemsCount(cartResponse.data?.data?.items?.length));
      }
    } catch (error) {
      // toast.error(`${t('Failed to send verification code')}`)
      console.log(error);
    }
  };

  useEffect(() => {
    fetchCategoriesData().then(() => {
      console.log("fetched restuarant style successfully");
    });

    fetchResStyleData();
    fetchCartData().then(() => {
      console.log("fetched cart item count successfully");
    });
  }, []);

  console.log("isLoading", isLoading);

  if (isLoading || !restaurantStyle) {
    return (
      <div className="w-screen h-screen flex items-center justify-center">
        <span className="loading loading-spinner text-primary"></span>
      </div>
    );
  }

  return (
    <>
      <Helmet>
        <title>{t("Home")}</title>
        <link
          rel="icon"
          type="image/png"
          href={restaurantStyle.logo}
          sizes="16x16"
        />
      </Helmet>

      <div
        style={{
          backgroundColor: restaurantStyle?.page_color,
          fontFamily: restaurantStyle.text_fontFamily,
        }}
      >
        <Herosection isMobile={isMobile} categories={categories || dummyData} />
        <ProductSection
          categories={categories || dummyData}
          isMobile={isMobile}
        />
        <FooterRestuarant />
      </div>
    </>
  );
};
