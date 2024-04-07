import unittest
import os
from selenium import webdriver
from selenium.webdriver.common.by import By
import HtmlTestRunner

class TestEditPublication(unittest.TestCase):
    
    def setUp(self):
        self.driver = webdriver.Chrome()
        self.driver.get("http://localhost/TAREA%204/home.php")

    def test_edit_publication(self):
        self.take_screenshot("1_home_page")

        edit_link = self.driver.find_element(By.LINK_TEXT, "Editar")
        edit_link.click()

        self.take_screenshot("2_edit_publication_page")

        title_input = self.driver.find_element(By.NAME, "titulo")
        title_input.clear()
        title_input.send_keys("Nuevo título de la publicación")

        content_input = self.driver.find_element(By.NAME, "contenido")
        content_input.clear()
        content_input.send_keys("Nuevo contenido de la publicación")

        save_button = self.driver.find_element(By.CSS_SELECTOR, "input[type='submit']")
        save_button.click()

        self.take_screenshot("3_publication_edited")

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
