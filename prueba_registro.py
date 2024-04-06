import unittest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import HtmlTestRunner
import os

class TestRegistration(unittest.TestCase):
    
    def setUp(self):
        self.driver = webdriver.Chrome()
        self.driver.get("http://localhost/TAREA%204/index.html")

    def test_registration(self):
        self.take_screenshot("registration_page")
        
        
        username_input = self.driver.find_element(By.ID, "username")
        email_input = self.driver.find_element(By.ID, "email")
        password_input = self.driver.find_element(By.ID, "password")
        register_button = self.driver.find_element(By.XPATH, "//input[@value='Registrarse']")

        username_input.send_keys("nombre_de_usuario")
        email_input.send_keys("correo_electronico@example.com")
        password_input.send_keys("contraseña123")
        
        self.take_screenshot("filled_registration_form")
        
        register_button.click()

       
        WebDriverWait(self.driver, 10).until(EC.url_to_be("http://localhost/TAREA%204/registro_exitoso.php"))
        self.take_screenshot("registration_successful")

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
