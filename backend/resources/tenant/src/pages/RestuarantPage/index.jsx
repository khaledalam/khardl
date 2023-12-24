import React from "react"
import NavbarRestuarant from "./components/Navbar"
import Herosection from "./components/Herosection"
import ProductSection from "./components/ProductSection"
import FooterRestuarant from "./components/Footer"

export const RestuarantHomePage = () => {
  return (
    <div>
      <NavbarRestuarant />
      <Herosection />
      <ProductSection />
      <FooterRestuarant />
    </div>
  )
}
