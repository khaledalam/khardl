import React, {useState} from "react"
import NavbarRestuarant from "./components/Navbar"
import Herosection from "./components/Herosection"
import ProductSection from "./components/ProductSection"
import FooterRestuarant from "./components/Footer"
import {productSectionList} from "./DATA"

export const RestuarantHomePage = () => {
  return (
    <div>
      <NavbarRestuarant />
      <Herosection alignment={"right"} />
      <ProductSection alignment={"right"} />
      <FooterRestuarant />
    </div>
  )
}
