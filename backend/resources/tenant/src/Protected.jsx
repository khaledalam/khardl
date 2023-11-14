import React, { useEffect } from 'react';
import { useNavigate } from "react-router-dom";
import CreateNewPassword from './pages/LoginSignUp/CreateNewPassword';
import {PREFIX_KEY} from "./config";

const Protected = (props) => {
    let Cmp = props.Cmp;
    const navigate = useNavigate();
    useEffect(() => {
        if (!sessionStorage.getItem(PREFIX_KEY + 'phone')) {
            if (props.Cmp === CreateNewPassword) {
                navigate("/reset-password");
            }
            // else {
            //     navigate("/login");
            // }
        }
        if (!localStorage.getItem('user-info')) {
            navigate("/login");
        }
    }, []);
    return (
        <div>
            <Cmp />
        </div>
    )
}

export default Protected;
