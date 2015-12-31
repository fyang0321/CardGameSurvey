

import java.util.Random;
import java.util.Scanner;

public class RandomFixedSum {
    private final static int COLUMN = 20;
    private final static int ROW = 200;
    private final static int UPPER = 100;
    private final static int LOWER = -100;
    private final static int POS_TARGET = 5;
    private final static int NEG_TARGET = -5;
    
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        int[][] matrix = new int[ROW][COLUMN];
        int rowIndex = 0;
        while (sc.hasNextLine() && rowIndex < ROW) {
            String[] nums = sc.nextLine().split(" ");
            for (int i = 0; i < COLUMN; i++)
                matrix[rowIndex][i] = Integer.parseInt(nums[i]);
            rowIndex++;
        }
        
        printRandomizedRow(matrix);
    }
    
    private static int getProperColumn(int[][] matrix, int selectedRow, int diff) {
        Random r = new Random();
        int selectedCol = r.nextInt(COLUMN);
        while (matrix[selectedRow][selectedCol] + diff > UPPER
               || matrix[selectedRow][selectedCol] + diff < LOWER) {
            selectedCol = r.nextInt(COLUMN);
        }
        
        return selectedCol;
    }
    
    private static void printRandomizedRow(int[][] matrix) {
        Random r = new Random();
        int row = r.nextInt(ROW);
        
        int[] output = new int[COLUMN];
        for (int i = 0; i < COLUMN; i++) {
            output[i] = matrix[row][i];
        }
        
        int sum = 0;
        for (int i = 0; i < COLUMN; i++) {
            sum += output[i];
        }
        
//        for (int i = 0; i < COLUMN; i++) {
//            System.out.print(output[i] + " ");
//        }
//        System.out.println("sum is " + sum);
        
        if (sum != POS_TARGET || sum != NEG_TARGET) {
            if (sum > 0) {
                int diff = sum - POS_TARGET;
                if (diff > 0) {
                    while (diff != 0) {
                        for (int i = 0; i < COLUMN; i++) {
                            if (output[i] + 1 <= 100) {
                                output[i]--;
                                diff--;
                                break;
                            }
                        }
                    }
                } else {
                    while (diff != 0) {
                        for (int i = 0; i < COLUMN; i++) {
                            if (output[i] - 1 >= -100) {
                                output[i]++;
                                diff++;
                                break;
                            }
                        }
                    }
                }
            } else {
                int diff = sum - NEG_TARGET;
                if (diff > 0) {
                    while (diff != 0) {
                        for (int i = 0; i < COLUMN; i++) {
                            if (output[i] + 1 <= 100) {
                                output[i]--;
                                diff--;
                                break;
                            }
                        }
                    }
                } else {
                    while (diff != 0) {
                        for (int i = 0; i < COLUMN; i++) {
                            if (output[i] - 1 >= -100) {
                                output[i]++;
                                diff++;
                                break;
                            }
                        }
                    }
                }
            }
        }
        
        for (int i = 0; i < COLUMN; i++) {
            int exchangeIndex = r.nextInt(COLUMN);
            swap(output, i, exchangeIndex);
        }
        
//        sum = 0;
        for (int i = 0; i < COLUMN; i++) {
            System.out.print(output[i] + " ");
//            sum += output[i];
        }
        
//        System.out.println();
//        System.out.println("sum is " + sum);
    }
    
    public static void swap(int[] arr, int i, int j) {
        int tmp = arr[i];
        arr[i] = arr[j];
        arr[j] = tmp;
    }
}