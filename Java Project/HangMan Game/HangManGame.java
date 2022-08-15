                    // *** HANGMAN GAME USING JOptionPane *** //

package hangman.game;
import javax.swing.JOptionPane;
/**
 *
 * @author LENOVO
 */
public class HangManGame {

    public static String[] words = {
        "guava",
        "fan",
        "wardrobe",
        "mirror",
        "ceiling",
        "water",
        "beverages",
        "milk",
        "lamp",
        "clock"
    };
    public static String instance = words[(int)(Math.random()*words.length)];
    public static String cencoredInstance = instance.replaceAll(".","*");
    public static int allowedAttempts = instance.length();
    public static boolean status = false;
    
    
    public static void main(String[] args) {
        String guess;
        while(status == false){
        	boolean found = false;
        	guess = JOptionPane.showInputDialog("Guess a letter \n" + cencoredInstance + "       " + allowedAttempts + " attemps left");
        	char charGuessed = guess.charAt(0);
        	cencoredInstance = hangman(charGuessed, found);
        	
        	
        }
    }
    public static String hangman(char charGuessed, boolean found) {
    	for(int i = 0; i < instance.length(); i++){
            if(cencoredInstance.charAt(i) == '*'){
                if(charGuessed == instance.charAt(i)){
                cencoredInstance = cencoredInstance.substring(0,i) + charGuessed + cencoredInstance.substring(i + 1);
                found = true;
                }
            }
            
    	}
    	if(!found){
    		allowedAttempts--;
    	}
        if(allowedAttempts == 0 || !cencoredInstance.contains("*")){
            if(cencoredInstance.contains("*"))
        	JOptionPane.showMessageDialog(null, "Game Over \nThe answer is \"" + instance + "\"");
            else
        	JOptionPane.showMessageDialog(null, "You won! The answer is \"" + instance + "\"");
            status = true;
        }
        return cencoredInstance;
    }
    
}
