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

    def test_create_publication(self):
        self.take_screenshot("create_publication_page")
        
        # Simular inicio de sesión (suponiendo que tenemos un usuario con sesión iniciada)
        # Aquí puedes incluir el inicio de sesión con Selenium si es necesario

        # Simular la creación de una publicación
        title_input = self.driver.find_element(By.ID, "title")
        content_input = self.driver.find_element(By.ID, "content")
        publish_button = self.driver.find_element(By.CSS_SELECTOR, "input[type='submit']")

        title_input.send_keys("Título de prueba")
        content_input.send_keys("Contenido de prueba")
        
        self.take_screenshot("filled_publication_form")
        
        publish_button.click()

        # Esperar a que la página de éxito de publicación se cargue
        WebDriverWait(self.driver, 10).until(EC.title_contains("Publicación Exitosa"))
        self.take_screenshot("publication_successful")

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
