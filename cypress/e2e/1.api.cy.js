const mockData = { id: 1, email: 'test@gmail.com', login: 'test@gmail.com' }

describe('API Testing', () => {
  context('Try to get users', () => {
    it('should not have data because we are not connected', () => {
      cy.request('GET', 'https://127.0.0.1:8000/users')
        .then((response) => {
          expect(response.redirects).to.not.be.empty
          expect(response.redirects[0]).to.include('login')
        })
    })

    it('should have data because we are connected', () => {
      cy.visit('https://127.0.0.1:8000');
      cy.get('#emailField').type('test@gmail.com');
      cy.get('#passwordField').type('testtest');
      cy.get('#btnLogin').click();
      cy.url().should('not.include', 'login', { timeout: 10000 });
      cy.request('GET', 'https://127.0.0.1:8000/users')
        .then((response) => {
          expect(response.status).to.be.eq(200)
          const res = response.body[0];
          expect(res.id).to.be.eq(mockData.id)
          expect(res.login).to.be.eq(mockData.login)
        })
    })
  })
})