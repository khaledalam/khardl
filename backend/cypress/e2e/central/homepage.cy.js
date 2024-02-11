describe('Test Central Homepage | Not Loggedin | Arabic Lang', () => {
  it('Homepage First Section', () => {
    cy.visit('http://khardl:8000');
    cy.contains("افتح طريقًا لجذب المزيد من العملاء دون الدفععمولات أو اشتراك الزامي");
      cy.contains("انشأ موقعك و تطبيقك مع خردل خلال دقائق و ابدأ البيع فورا و ادفع على قد طلباتك فقط");
      cy.contains("ابدأ البيع على الفور،");
  });

    it('Homepage First Section | Click start now button', () => {
        cy.visit('http://khardl:8000');
        cy.contains("ابدأ الآن").click();
        cy.contains("إنشاء حساب"); // show register form
    });
});


describe('Test Central Homepage | Not Loggedin | Switching Language', () => {
    it('Homepage Switch Language To Arabic', () => {
        cy.visit('http://khardl:8000');
        // @TODO: click language switch button
    });
});
