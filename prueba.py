import unittest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import HtmlTestRunner
import os

class TestLogin(unittest.TestCase):
    
    def setUp(self):
        self.driver = webdriver.Chrome()
        self.driver.get("http://localhost/Tarea%204/inicio_sesion.html")

    def test_successful_login(self):
        self.take_screenshot("login_page")
        username_input = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.ID, "login_email"))
        )
        password_input = self.driver.find_element(By.ID, "login_password")
        login_button = self.driver.find_element(By.CSS_SELECTOR, "input[type='submit']")

        username_input.send_keys("carlossanchezcoplin@gmail.com")
        password_input.send_keys("123")
        self.take_screenshot("filled_login_form")
        login_button.click()
        self.take_screenshot("successful_login")

    def test_failed_login(self):
        self.take_screenshot("login_page")
        username_input = self.driver.find_element(By.ID, "login_email")
        password_input = self.driver.find_element(By.ID, "login_password")
        login_button = self.driver.find_element(By.CSS_SELECTOR, "input[type='submit']")

        username_input.send_keys("usuarioincorrecto@example.com")
        password_input.send_keys("contraseñaincorrecta")
        self.take_screenshot("filled_login_form_with_wrong_credentials")
        login_button.click()

        error_message_element = WebDriverWait(self.driver, 10).until(
            EC.visibility_of_element_located((By.XPATH, "//p[contains(text(), 'Credenciales incorrectas')]"))
        )
        self.take_screenshot("failed_login")
        self.assertTrue(error_message_element.is_displayed())

    def tearDown(self):
        self.driver.quit()

    def take_screenshot(self, step_name):
        screenshot_folder = "screenshots"
        if not os.path.exists(screenshot_folder):
            os.makedirs(screenshot_folder)
        filename = f"{screenshot_folder}/{step_name}.png"
        self.driver.save_screenshot(filename)

if __name__ == "__main__":
    unittest.main(testRunner=HtmlTestRunner.HTMLTestRunner(output='reportes'))
