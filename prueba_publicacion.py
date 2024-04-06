import unittest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import HtmlTestRunner
import os

class TestCreatePublication(unittest.TestCase):
    
    def setUp(self):
        self.driver = webdriver.Chrome()
        self.driver.get("http://localhost/TAREA%204/crear_publicacion.html")

    def test_create_publication_without_login(self):
        self.take_screenshot("create_publication_page")


        title_input = self.driver.find_element(By.ID, "titulo")
        content_input = self.driver.find_element(By.ID, "contenido")
        publish_button = self.driver.find_element(By.CSS_SELECTOR, "input[type='submit']")

        title_input.send_keys("Título de prueba")
        content_input.send_keys("Contenido de prueba")
        
        self.take_screenshot("filled_publication_form")
        
        publish_button.click()

      
        WebDriverWait(self.driver, 10).until(EC.url_to_be("http://localhost/TAREA%204/home.php"))
        self.take_screenshot("filled_publication_form")

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
