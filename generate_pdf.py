
import os
from fpdf import FPDF

# Configuration
PROJECT_DIR = r"c:\xampp\htdocs\cert"
OUTPUT_FILE = "project_code.pdf"
EXTENSIONS = ['.php']

class PDF(FPDF):
    def header(self):
        self.set_font("Arial", "B", 12)
        self.cell(0, 10, "Project Source Code", 0, 1, "C")

    def chapter_title(self, title):
        self.set_font("Arial", "B", 12)
        self.set_fill_color(200, 220, 255)
        self.cell(0, 6, f"File: {title}", 0, 1, "L", True)
        self.ln(4)

    def chapter_body(self, body):
        self.set_font("Courier", "", 10)
        self.multi_cell(0, 5, body)
        self.ln()

def generate_pdf():
    pdf = PDF()
    pdf.set_auto_page_break(auto=True, margin=15)
    pdf.add_page()
    
    files_processed = 0
    
    for root, dirs, files in os.walk(PROJECT_DIR):
        for file in files:
            if any(file.endswith(ext) for ext in EXTENSIONS):
                file_path = os.path.join(root, file)
                rel_path = os.path.relpath(file_path, PROJECT_DIR)
                
                print(f"Processing: {rel_path}")
                
                try:
                    with open(file_path, 'r', encoding='utf-8', errors='replace') as f:
                        content = f.read()
                    
                    pdf.chapter_title(rel_path)
                    pdf.chapter_body(content)
                    files_processed += 1
                except Exception as e:
                    print(f"Error reading {file_path}: {e}")

    pdf.output(OUTPUT_FILE)
    print(f"\nPDF generated successfully: {OUTPUT_FILE}")
    print(f"Total files processed: {files_processed}")

if __name__ == "__main__":
    generate_pdf()
