import unittest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import HtmlTestRunner
import os

class TestSearchPublications(unittest.TestCase):
    
    def setUp(self):
        self.driver = webdriver.Chrome()
        self.driver.get("http://localhost/TAREA%204/home.php")

    def test_search_publications(self):
        self.take_screenshot("search_publications_page")

        search_input = self.driver.find_element(By.ID, "search")
        search_input.send_keys("Término de búsqueda")
        search_button = self.driver.find_element(By.CSS_SELECTOR, "input[type='submit']")
        search_button.click()

        self.take_screenshot("search_results")

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
